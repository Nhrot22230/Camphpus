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
        Schema::create('administrador', function (Blueprint $table) {
            $table->string('codAdmin')->primary();
            $table->unsignedInteger('fid_usuario')->unique();

            $table->foreign('fid_usuario')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->timestamps();
            // Otros campos específicos de Administrador
            // Por ejemplo:
            // $table->string('departamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
