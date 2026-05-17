<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\GamesDBService;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pagesByConsole=5;
        for($x=1;$x<=$pagesByConsole;$x++){
            $games=GamesDBService::fetchByConsole("X360",$x);
            foreach($games as $game){
                DB::table('products')->insert($game);
            }
        }
        for($p=1;$p<=$pagesByConsole;$p++){
            $games=GamesDBService::fetchByConsole("PS3",$p);
            foreach($games as $game){
                DB::table('products')->insert($game);
            }
        }
        for($w=1;$w<=$pagesByConsole;$w++){
            $games=GamesDBService::fetchByConsole("WII",$w);
            foreach($games as $game){
                DB::table('products')->insert($game);
            }
        }
    }
}
