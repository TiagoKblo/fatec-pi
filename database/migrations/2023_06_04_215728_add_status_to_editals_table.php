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
            $table->enum('status', ['A', 'F', 'C'])
                ->comment('A - Aberto, F - Finalizado, C - Cancelado')
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
