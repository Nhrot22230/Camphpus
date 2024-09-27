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
        Schema::create('candidato', function (Blueprint $table) {
            $table->string('codCandidato')->primary();
            $table->unsignedInteger('fid_usuario')->unique();

            $table->foreign('fid_usuario')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->timestamps();
            // Otros campos específicos de CandidatoDocente
            // Por ejemplo:
            // $table->string('nivel_educativo');
            // $table->string('estado_candidatura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato');
    }
};
