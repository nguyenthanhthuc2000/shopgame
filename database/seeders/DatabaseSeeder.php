<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        $this->call(CategorySeeder::class);
        $this->call(FakeTransactionSeeder::class);
        $this->call(FakeNickTransactionSeeder::class);
    }
}
