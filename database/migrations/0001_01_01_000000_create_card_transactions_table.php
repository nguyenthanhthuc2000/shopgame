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
        Schema::create('card_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('callback_sign', 255);
            $table->integer('status')->nullable();
            $table->string('request_id', 255)->nullable();
            $table->string('telco', 50)->comment('Viettel, Vina, ...');
            $table->string('serial', 100);
            $table->string('code', 100)->nullable();
            $table->unsignedBigInteger('trans_id')->nullable();
            $table->integer('value')->nullable();
            $table->string('message', 255)->nullable();
            $table->integer('declared_value')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('response_code')->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->text('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_transactions');
    }
};
