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
        Schema::table('manifesto_interesses', function (Blueprint $table) {
            $table->enum('status_pontuacao', ['EA', 'D', 'I'])->default('EA')
                ->comment('EA - Em análise, D - Deferido, I - Indeferido');
            $table->enum('status_comprovante', ['EA', 'D', 'I'])->default('EA')
                ->comment('EA - Em análise, D - Deferido, I - Indeferido');
            $table->text('motivo_indeferimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manifesto_interesses', function (Blueprint $table) {
            $table->dropColumn('status_pontuacao');
            $table->dropColumn('status_comprovante');
            $table->dropColumn('motivo_indeferimento');
        });
    }
};
