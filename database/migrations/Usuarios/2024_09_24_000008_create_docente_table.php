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
        Schema::create('docente', function (Blueprint $table) {
            $table->integer('codDocente')->primary();
            $table->unsignedInteger('fid_usuario')->unique();

            $table->foreign('fid_usuario')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->timestamps();
            // Otros campos específicos de Docente
            // Por ejemplo:
            // $table->string('especialidad');
            // $table->date('fecha_contratacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente');
    }
};
