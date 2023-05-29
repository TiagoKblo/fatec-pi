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
        Schema::create('manifesto_interesses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('edital');

           

            $table->date('partir_de');

            // docs. uploads
            $table->string('pontuacao');
            $table->string('comprovante');

            $table->foreign('usuario')->references('id')->on('users');
            $table->foreign('edital')->references('id')->on('editals');

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
