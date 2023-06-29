<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Executa as migrations.
     */
    public function up(): void
    {
        Schema::create('editais', function (Blueprint $table) {
            $table->id();
            $table->string('numero_edital')->unique();
            $table->string('curso');
            $table->string('disciplina');
            $table->string('turno');
            $table->integer('horas_aula');
            $table->integer('dia_da_semana');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->enum('prazo', ['D', 'I']);
            $table->string('anexo_edital');
            $table->enum('status', ['A', 'F', 'C', 'CA', 'P', 'E', 'CN', 'RI', 'EA', 'DP', 'FI', 'RPP', 'RR', 'AR', 'RP'])
                ->comment('A - Aberto, F - Finalizado, C - Cancelado, CA - Cadastrado, P - Publicado, E - Errata, CN - Cancelado (Sem Inscrições), RI - Recebendo Inscrições, EA - Em Análise, DP - Deferimentos Publicados, FI - Finalizado sem Inscritos, RPP - Resultado Parcial Publicado, RR - Recebendo Recursos, AR - Analisando Recursos, RP - Resultado Publicado')
                ->default('CA');
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editais');
    }
};
