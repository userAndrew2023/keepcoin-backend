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
        Schema::create('telegram_user_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('telegram_user_id');
            $table->foreignId('task_id');
            $table->enum('status', ['started', 'verified', 'claimed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_user_tasks');
    }
};
