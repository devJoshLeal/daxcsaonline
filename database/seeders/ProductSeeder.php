<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'title' => 'The Legend of Zelda: Breath of the Wild',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/42293-1.jpg',
                'public_id' => 42293,
                'genre' => 'Action-Adventure',
                'platform' => 'Nintendo Switch',
                'release_date' => '2017-03-03',
                'price' => 59.99,
                'description' => 'An open-world action-adventure game set in the land of Hyrule.',
                'rating' => 'E10+',
            ],
            [
                'title' => 'God of War',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/73778-1.jpg',
                'public_id' => 73778,
                'genre' => 'Action RPG',
                'platform' => 'PlayStation 4',
                'release_date' => '2018-04-20',
                'price' => 29.99,
                'description' => 'A story-driven action-adventure game following Kratos and his son.',
                'rating' => 'M',
            ],
            [
                'title' => 'Minecraft',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/50424-1.jpg',
                'public_id' => 50424,
                'genre' => 'Sandbox',
                'platform' => 'PC',
                'release_date' => '2011-11-18',
                'price' => 26.95,
                'description' => 'A sandbox game that allows players to build and explore virtual worlds.',
                'rating' => 'E10+',
            ],
            [
                'title' => 'The Witcher 3: Wild Hunt',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/33255-1.jpg',
                'public_id' => 33255,
                'genre' => 'Action RPG',
                'platform' => 'PC',
                'release_date' => '2015-05-19',
                'price' => 39.99,
                'description' => 'An open-world RPG set in a rich fantasy universe.',
                'rating' => 'M',
            ],
            [
                'title' => 'Super Mario Odyssey',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/42320-1.jpg',
                'public_id' => 42320,
                'genre' => 'Platformer',
                'platform' => 'Nintendo Switch',
                'release_date' => '2017-10-27',
                'price' => 59.99,
                'description' => 'A 3D platformer featuring Mario on a globe-trotting adventure.',
                'rating' => 'E',
            ],
            [
                'title' => 'FINAL FANTASY VII REBIRTH',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/130495-1.jpg',
                'public_id' => 130495,
                'genre' => 'RPG',
                'platform' => 'PlayStation 5',
                'release_date' => '2025-01-23',
                'price' => 69.99,
                'description' => 'A role-playing game set in a fantasy world.',
                'rating' => 'M',
            ],
            [
                'title' => 'Resident Evil 4',
                'image' => 'https://cdn.thegamesdb.net/images/thumb/boxart/front/105569-1.jpg',
                'public_id' => 105569,
                'genre' => 'Survival Horror',
                'platform' => 'PlayStation 5',
                'release_date' => '2023-03-24',
                'price' => 49.99,
                'description' => 'A survival horror game set in a creepy atmosphere.',
                'rating' => 'M',
            ],


        ]);
    }
}
