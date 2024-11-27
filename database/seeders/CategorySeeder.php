<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'nick-ngoc-rong',
                'name' => 'Nick Ngọc Rồng',
                'description' => 'nickdaoquan.vn -Ngọc rồng online, mua bán vàng, mua bán ngọc, mua nick ngọc rồng online, shop nick ngọc rồng online',
                'title' => 'Shop Nick Ngọc Rồng Online',
                'status' => 1,
                'noti' => '',
                'image' => 'uploads/nick-ngoc-rong.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'kho-do-ngoc-rong',
                'name' => 'Kho Đồ NRO',
                'description' => 'nickdaoquan.vn - Ngọc rồng online, mua bán vàng, mua bán ngọc, mua nick ngọc rồng online, shop nick ngọc rồng online',
                'title' => 'Shop Đồ Ngọc Rồng Online',
                'status' => 1,
                'noti' => '',
                'image' => 'uploads/kho-do-ngoc-rong.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'nick-ngoc-rong-so-sinh',
                'name' => 'Nick NRO Sơ Sinh',
                'description' => 'nickdaoquan.vn - Ngọc rồng online, mua bán vàng, mua bán ngọc, mua nick ngọc rồng online, shop nick ngọc rồng online',
                'title' => 'Shop Đồ Ngọc Rồng Online',
                'status' => 1,
                'noti' => '',
                'image' => 'uploads/nick-ngoc-rong-so-sinh.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'nick-lien-quan',
                'name' => 'Nick Liên Quân',
                'description' => 'nickdaoquan.vn - Shop Acc Game Liên Quân Uy Tín Giá Rẽ',
                'title' => 'Shop Nick Liên Quân',
                'status' => 1,
                'noti' => '',
                'image' => 'uploads/nick-lien-quan.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        DB::table('categories')->insert($categories);
    }
}
