<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GamesDBService
{
    public static function fetchByConsole($platform = "PS3", $page = 1)
    {
        $fetchedGames = [];
        // BUsca si el archivo JSON con el catalogo de juegos ya esta en el storage privado
        $fullrequest = Storage::json($platform . "_games_p_$page.json");
        if (!isset($fullrequest)) {
            // Si no se encuentra, hace una petición a la api de theGamesDB
            $platformId = self::getPlatId($platform); // Se busca el platform ID
            if ($platformId == 0) {
                return null;
            }
            $response = Http::get('api.thegamesdb.net/v1/Games/ByPlatformID', [
                'apikey' => env('THEGAMES_API'),
                'id' => $platformId,
                'include' => 'boxart',
                'fields' => 'rating,players,genres,overview,publishers',
                'page' => $page
            ]);
            if ($response->ok()) {
                // Si la petición es correcta, se copia la respuesta en un archivo json
                Storage::disk('local')->put($platform . "_games_p_$page.json", $response->body());
            }
            $fullrequest = $response->json();
        }
        if (!isset($fullrequest["data"])) {
            return null;
        }
        $games = $fullrequest["data"]["games"];

        foreach ($games as $index => $game) {

            $gameId = $game["id"];

            $gameCovers = $fullrequest["include"]["boxart"]["data"][$gameId];
            $games[$index]["boxart"] = self::frontBoxart($gameCovers);

            $fetchedGames[$index] = [
                "title" => $game["game_title"],
                "image" => $games[$index]["boxart"],
                "genre" => isset($game["genres"]) ? self::genres($game["genres"]) : "Other",
                "platform" => self::platform($game["platform"]),
                "release_date" => $game["release_date"],
                "description" => $game["overview"],
                "rating" => $game["rating"],
            ];
        }

        return $fetchedGames;
    }

    protected static function genres($genres = [1, 4, 18])
    {
        $gstring = "";

        $fullrequest = Storage::json('genres.json');

        foreach ($genres as $index => $genre) {

            $gstring .= $fullrequest["data"]["genres"][$genre]["name"];

            $gstring .= $index != sizeof($genres) - 1 ? ", " : "";
        }

        return $gstring;
    }

    protected static function frontBoxart($covers = [])
    {
        $imgUrl = "https://cdn.thegamesdb.net/images/medium/";
        foreach ($covers as $index => $cover) {
            if ($cover["side"] == "front") {
                return $imgUrl . $cover["filename"];
            }
        }
    }

    protected static function platform($platformId = 12)
    {
        switch ($platformId) {
            case 9:
                return "Nintendo Wii";
            case 12:
                return "Sony Playstation 3";
                break;
            case 15:
                return "Microsoft Xbox 360";
            default:
                $fullrequest = Storage::json('platforms.json');
                return $fullrequest["data"]["platforms"][$platformId]["name"];
        }
    }
    protected static function getPlatId($platform = "PS3")
    {
        switch ($platform) {
            case "WII":
                return 9;
            break;
            case "PS3":
                return 12;
            break;
            case "X360":
                return 15;
            break;
            default:
                return 0;

        }
    }
}
