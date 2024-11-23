<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FakeTransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $transactions = [];

        for ($i = 0; $i < 100; $i++) {
            $transactions[] = [
                'callback_sign' => $faker->md5,
                'status' => $faker->randomElement([0, 1, 2]),
                'request_id' => $faker->uuid,
                'telco' => $faker->randomElement(['Viettel', 'Vinaphone', 'Mobifone']),
                'serial' => $faker->numerify('#############'),
                'code' => $faker->numerify('#############'),
                'trans_id' => $faker->randomNumber(8, true),
                'value' => 500000,
                'message' => null,
                'declared_value' => 500000,
                'amount' => 400000,
                'response_code' => $faker->randomElement([200, 400, 500]),
                'user_id' => $faker->numberBetween(1, 50),
                'log' => $faker->text(100),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('card_transactions')->insert($transactions);
    }
}
