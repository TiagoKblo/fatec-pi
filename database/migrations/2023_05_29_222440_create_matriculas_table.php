<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('unidade')->default('Fatec Itapira - Ogari de Castro Pacheco');

            $table->char('grau', 1)->default('A');
            $table->enum('pes', [1, 2, 3])->default(1);

            $table->string('cargo')->enum(['PROFESSOR', 'COORDENADOR', 'ADMINISTRADOR'])->default('PROFESSOR');

            $table->char('celular', 11)->nullable();
            $table->char('telefone', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
