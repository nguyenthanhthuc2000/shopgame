<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nick_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->comment('Mã giao dịch');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->decimal('price', 10, 2)->comment('Giá nick (buyer_vnd)');
            $table->decimal('seller_profit', 10, 2)->comment('Thực nhận của seller (seller_vnd)');
            $table->integer('profit_rate')->comment('users.profit_rate Tỉ lệ lợi nhuận của admin đã thiết lập (Theo setting của từng user');
            $table->tinyInteger('order_status')->default(0)->comment('Trạng thái dịch: 0: processing (Xảy ra khi khi khách đã thanh toán nhưng acc vẩn chưa tới tay khách: xử lí check acc lỗi / cần phải giao dịch qua zalo, ... ), 1: completed, 2: canceled'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nick_transactions');
    }
};
