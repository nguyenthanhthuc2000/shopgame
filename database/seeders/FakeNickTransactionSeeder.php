<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FakeNickTransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $transactions = [];

        for ($i = 0; $i < 100; $i++) {
            $transactions[] = [
                'user_id' => $faker->numberBetween(1, 50),
                'amount' => $faker->randomFloat(2, 1000, 500000),
                'buyer_vnd' => $faker->randomFloat(2, 1000, 550000),
                'ip' => $faker->ipv4,
                'type' => 1,
                'note' => $faker->text(50),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn dữ liệu vào bảng 'transactions'
        DB::table('bank_transactions')->insert($transactions);
    }
}
