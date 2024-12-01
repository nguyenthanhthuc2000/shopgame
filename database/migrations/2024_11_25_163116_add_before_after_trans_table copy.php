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
            $table->decimal('seller_vnd_before', 12, 2)->default(0)->after('profit_rate'); // Số dư trước giao dịch của CTV
            $table->decimal('seller_vnd_after', 12, 2 )->default(0)->after('profit_rate'); // Số dư sau giao dịch của CTV
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['seller_vnd_before', 'seller_vnd_after']);
        });
    }
};
