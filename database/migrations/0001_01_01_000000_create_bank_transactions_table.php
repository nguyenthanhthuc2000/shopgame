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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Người được nhận tiền');
            $table->decimal('amount', 10, 2)->comment('Tiền admin đã nhận qua ATM, MOMO');
            $table->decimal('buyer_vnd', 10, 2)->comment('Tiền người nạp sẽ nhận (cộng vào buyer_vnd)'); 
            $table->string('ip', 100)->comment('IP Admin thực hiện tạo lệnh nap');
            $table->tinyInteger('type')->default(0)->comment('1: Cộng tiền, 0: Trừ tiền');
            $table->string('note', 255)->nullable(); // Ghi chú của admin khi tạo lệnh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
