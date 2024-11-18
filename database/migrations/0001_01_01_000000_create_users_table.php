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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 255)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: Hoạt động, 0: Bị khoá không thể thao tác, login');
            $table->enum('role', ['admin', 'buyer', 'seller'])->default('buyer');
            $table->decimal('seller_vnd', 10, 2)->default(0)->comment('Số dư có thể mua nick');
            $table->decimal('buyer_vnd', 10, 2)->default(0)->comment('Số dư có thể rút');
            $table->integer('buyer_exchange_rate')->default(0)->comment('Tỉ lệ đổi tiền từ buyer_vnd -> buyer');
            $table->integer('seller_exchange_rate')->default(0)->comment('Tỉ lệ đổi tiền từ seller_vnd -> seller');
            $table->integer('profit_rate')->default(70)->comment('Tỉ lệ nhận tiền của ctv khi bán nick');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
