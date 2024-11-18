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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('description', 255)->nullable();
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_top')->default(0);
            $table->tinyInteger('is_publish')->default(0);
            $table->text('image')->nullable()->comment('Ảnh thu nhỏ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
