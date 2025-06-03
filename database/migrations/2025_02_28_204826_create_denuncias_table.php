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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();

            $table->json('denuncia'); // campo JSON para múltiplas opções
            $table->string('profile_or_content'); // 'profile' ou 'content'
            $table->string('profile_or_content_id');

            $table->unsignedBigInteger('user_id'); // quem denunciou
            $table->unsignedBigInteger('conteudo_id')->nullable(); // se for denúncia de conteúdo
            $table->unsignedBigInteger('denunciado_id')->nullable(); // se for denúncia de perfil

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('conteudo_id')
                ->references('id')
                ->on('conteudos')
                ->onDelete('cascade');

            $table->foreign('denunciado_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
