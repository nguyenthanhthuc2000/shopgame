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
        Schema::table('accounts', function (Blueprint $table) {
            $table->tinyInteger('server')->after('status');
            $table->tinyInteger('class')->after('server');
            $table->boolean('earring')->default(0)->after('class');
            $table->tinyInteger('regis_type')->default(0)->after('earring');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
