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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 50)->nullable();
            $table->string('partner_id', 50)->nullable();
            $table->string('partner_key', 50)->nullable();
            $table->boolean('viettel_flg')->default(1);
            $table->boolean('vina_flg')->default(1);
            $table->boolean('mobi_flg')->default(0);
            $table->boolean('zing_flg')->default(1);
            $table->boolean('garena_flg')->default(1);
            $table->boolean('gate_flg')->default(1);
            $table->boolean('vcoin_flg')->default(1);
            $table->boolean('scoin_flg')->default(1);
            $table->tinyInteger('status')->default(0)->comment('0: Bảo trì nạp thẻ, 1: Nạp thẻ cào bình thường');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
