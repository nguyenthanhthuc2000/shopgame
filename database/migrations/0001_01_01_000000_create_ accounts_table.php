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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->decimal('price', 10, 2)->default(0)->comment('Giá bán (card)');
            $table->decimal('discount_price', 10, 2)->default(0)->comment('Giá bán sau khi giảm (card), nếu giá giảm > 0 sẽ hiển thị giá giảm');
            $table->string('username', 100);
            $table->string('password', 255)->nullable()->comment('Một số game có thể phải giao dịch trực tiếp nên không cần nhập mật khẩu');
            $table->unsignedBigInteger('user_id')->comment('Người đăng nick');
            $table->unsignedBigInteger('category_id')->default(0);
            $table->string('note', 255)->nullable()->comment('Mô tả thêm về nick');
            $table->tinyInteger('status')->default(2)->comment('Trạng thái: 0: Ẩn, 1: Đang bán, 2: Đã bán');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
