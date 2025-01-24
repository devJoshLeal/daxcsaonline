<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('test1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => bcrypt('test1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fulano Silva',
                'email' => 'fulano@example.com',
                'password' => bcrypt('test1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beltrano Silva',
                'email' => 'beltrano@example.com',
                'password' => bcrypt('test1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
