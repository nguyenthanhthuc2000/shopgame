<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'slug' => 'lam-de-tu',
                'name' => 'Làm Đệ Tử',
                'description' => '
                    Nick sơ sinh : yêu cầu từ nhiệm vụ heo rừng trở lên = thời gian làm 24h - 48h. 
                    👉Nick có skill5 : yêu cầu sp có skill bom hoặc qckk hoặc laze. 👉Săn trứng mabư : yêu cầu sp trên 150tr sm + chuẩn bị 30 ngọc, tg làm 2 - 7 ngày. 
                    👉Không vào nick khi đang thuê. 
                    👉Sau khi lên đơn thì ae nhắn tin qua zalo 0389946423 hoặc FB chủ shop để đc tiếp nhận đơn nhanh nhất có thể nhé.',
                'title' => 'Làm Đệ Tử Thuê | Nickdaoquan.vn',
                'status' => 1,
                'image' => 'uploads/lam-de-tu-thue-ngoc-rong.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'up-suc-manh-de-tu',
                'name' => 'Up Sức Mạnh Đệ Tử',
                'description' => '
                    👉Up từ 150tr - 1ti499tr yêu cầu skill2 trên cấp 4 và qua đc map nappa. 
                    👉Thời gian up từ 3 ngày đến 7 ngày. 
                    👉Có thể tự chuẩn bị bùa để up nhanh hơn ( Không bắt buộc). 
                    👉Không vào nick khi đang thuê. 
                    👉Sau khi lên đơn thì ae nhắn tin qua zalo 0389946423 hoặc fb Chủ shop để đc tiếp nhận đơn nhanh nhất có thể nhé.',
                'title' => 'Làm Đệ Tử Thuê | Nickdaoquan.vn',
                'status' => 1,
                'image' => 'uploads/up-de-tu-thue-ngoc-rong.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        DB::table('services')->insert($services);
    }
}
