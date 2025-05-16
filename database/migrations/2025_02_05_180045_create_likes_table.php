<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            //Criando chave estrangeira
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('conteudo_id');
            //relacionando a chave "user_id" com o id da tabela "user"
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('conteudo_id')
                ->references('id')
                ->on('conteudos')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('likes');
    }
};