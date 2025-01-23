<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
        $token = bin2hex(random_bytes(32));
            \DB::table('personal_access_tokens')->insert([
                'user_id' => $user->id,
                'token' => $token,
                'last_used_at' => now(),
                'expires_at' => now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
