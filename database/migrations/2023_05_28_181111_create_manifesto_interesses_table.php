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
        Schema::create('manifesto_interesses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('edital');

            $table->date('partir_de');

            // docs. uploads
            $table->string('pontuacao');
            $table->string('comprovante');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('edital')->references('id')->on('editais');

            $table->enum('status', ['R', 'D', 'I', 'C'])
                ->comment('R - Registrado, D - Deferido, I - Indeferido, C - Convocado')
                ->default('R');

            $table->enum('status_pontuacao', ['EA', 'D', 'I'])->default('EA')
                ->comment('EA - Em análise, D - Deferido, I - Indeferido');

            $table->enum('status_comprovante', ['EA', 'D', 'I'])->default('EA')
                ->comment('EA - Em análise, D - Deferido, I - Indeferido');

            $table->text('motivo_indeferimento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifesto_interesses');
    }
};
