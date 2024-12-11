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
        Schema::create('service_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Người thuê');
            $table->unsignedBigInteger('service_task_id')->comment('Dịch vụ');
            $table->tinyInteger('server');
            $table->string('username', 100);
            $table->string('password', 255)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1. Xong, 2. Hủy. 3. Đang xử lí');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_jobs');
    }
};
