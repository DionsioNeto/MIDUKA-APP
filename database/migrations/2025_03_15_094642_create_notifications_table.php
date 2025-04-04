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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_from');

            $table->foreign('id_from')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->string('id_to');
            $table->string('content_notification');
            $table->boolean('verify')
            ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
