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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100);
            $table->string('name', 100);
            $table->text('description')->nullable()->comment('SEO');
            $table->text('title')->nullable()->comment('SEO');
            $table->tinyInteger('status')->default(0)->comment('1. Hiện, 2. Ẩn');
            $table->string('image')->nullable()->comment('Ảnh thu nhỏ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
