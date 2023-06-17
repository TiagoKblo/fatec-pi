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
            $table->enum('status', ['A', 'F', 'C', 'CA', 'P', 'E', 'CN', 'RI', 'RR', 'RP', 'FI', 'RP', 'RR', 'AR', 'RP'])
                ->comment('A - Aberto, F - Finalizado, C - Cancelado, CA - Cadastrado, P - Publicado, E - Errata, CN - Cancelado (Sem Inscrições), RI - Recebendo Inscrições, RR - Em Análise, RP - Deferimentos Publicados, FI - Finalizado sem Inscritos, RP - Resultado Parcial Publicado, RR - Recebendo Recursos, AR - Analisando Recursos, RP - Resultado Publicado')
                ->default('A')
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
