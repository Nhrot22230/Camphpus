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
        Schema::create('solicitud_carta_presentacion', function (Blueprint $table) {
            $table->increments('idSolicitudCartaPresentacion');
            $table->unsignedInteger('fid_estudiante');
            $table->unsignedInteger('fid_asesor');
            $table->unsignedInteger('fid_directorCarrera');
            $table->unsignedInteger('fid_secretario');
            $table->unsignedInteger('fid_curso');
            $table->binary('carta_presentacion');
            $table->json('actividades');
            $table->string('estado');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('fid_estudiante')->references('idEstudiante')->on('estudiante');
            $table->foreign('fid_asesor')->references('idDocente')->on('docente');
            $table->foreign('fid_directorCarrera')->references('idAdministrador')->on('administrador');
            $table->foreign('fid_secretario')->references('idAdministrador')->on('administrador');
            $table->foreign('fid_curso')->references('idCurso')->on('curso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_carta_presentacion');
    }
};
