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
        Schema::create('editals', function (Blueprint $table) {
            $table->id();
            $table->string('numero_edital');
            $table->string('curso');
            $table->string('disciplina');
            $table->string('turno');
            $table->integer('horas_aula');
            $table->integer('dia_da_semana');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->enum('prazo', ['determinado', 'indeterminado']);
            $table->string('anexo_edital');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editals');
    }
};
