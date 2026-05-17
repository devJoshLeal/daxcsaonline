<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'product_id' => 1,
                'user_id' => 3,
                'quantity' => 2,
                'tracking_id' => 'TRACK123',
                'order_date' => Carbon::now(),
                'delivery_date' => Carbon::now()->addDays(5),
                'phone' => '123-456-7890', // Example phone
                'address' => '123 Main St, Anytown, USA', // Example address
            ],
        ]);
    }
}
