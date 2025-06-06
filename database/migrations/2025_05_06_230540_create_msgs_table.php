<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('msgs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('description');
            $table->string('typeProblem');

            //Criando chave estrangeira
            $table->unsignedBigInteger('user_id');

            //relacionando a chave "user_id" com o id da tabela "user"
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('msgs');
    }
};
