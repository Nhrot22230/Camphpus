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
            $table->integer('fid_estudiante');
            $table->integer('fid_asesor');
            $table->integer('fid_directorCarrera');
            $table->integer('fid_secretario');
            $table->binary('carta_presentacion');
            $table->json('actividades');
            $table->string('estado');
            $table->integer('fid_curso');
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
