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
        Schema::table('editals', function (Blueprint $table) {
            $table->enum('status', ['A', 'F', 'C', 'CA', 'P', 'E', 'CN', 'RI', 'EA', 'DP', 'FI', 'RPP', 'RR', 'AR', 'RP'])
                ->comment('A - Aberto, F - Finalizado, C - Cancelado, CA - Cadastrado, P - Publicado, E - Errata, CN - Cancelado (Sem Inscrições), RI - Recebendo Inscrições, EA - Em Análise, DP - Deferimentos Publicados, FI - Finalizado sem Inscritos, RPP - Resultado Parcial Publicado, RR - Recebendo Recursos, AR - Analisando Recursos, RP - Resultado Publicado')
                ->default('CA')
                ->after('anexo_edital');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('editals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
