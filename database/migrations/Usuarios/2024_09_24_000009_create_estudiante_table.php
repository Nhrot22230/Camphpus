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
        Schema::create('estudiante', function (Blueprint $table) {
            $table->string('codEstudiante')->primary();
            $table->unsignedInteger('fid_usuario')->unique();

            $table->foreign('fid_usuario')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->timestamps();
            // Otros campos específicos de Estudiante
            // Por ejemplo:
            // $table->string('carrera');
            // $table->integer('año_ingreso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};
