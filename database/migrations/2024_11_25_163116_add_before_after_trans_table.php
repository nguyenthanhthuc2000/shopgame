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
        Schema::table('account_transactions', function (Blueprint $table) {
            $table->decimal('buyer_vnd_before', 12, 2)->default(0)->after('profit_rate'); // Số dư trước giao dịch
            $table->decimal('buyer_vnd_after', 12, 2 )->default(0)->after('profit_rate'); // Số dư sau giao dịch
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['buyer_vnd_before', 'buyer_vnd_after']);
        });
    }
};
