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
        Schema::create('matricula_adicional', function (Blueprint $table) {
            $table->increments('idMatriculaAdicional')->primary();
            $table->integer('fid_estudiante'); // Relación con la tabla estudiantes
            $table->integer('fid_curso'); // Relación con la tabla cursos
            $table->integer('fid_director_asociado'); // Relación con la tabla administrativos (director)
            $table->integer('fid_secretario_academico'); // Relación con la tabla administrativos (secretario)
            $table->integer('fid_horario'); // Relación con la tabla horarios
            $table->string('motivo'); // Motivo de la solicitud
            $table->string('justificacion'); // Justificación del estudiante
            $table->string('semestre'); // Identificador del semestre
            $table->enum('etapa_matricula_adicional', ['inicio', 'proceso', 'finalizado']); // Etapa de la matrícula
            $table->boolean('activo'); // Estado de la matrícula
            $table->timestamps();

            $table->foreign('fid_estudiante')->references('idEstudiante')->on('estudiantes');
            $table->foreign('fid_curso')->references('idCurso')->on('curso');
            $table->foreign('fid_director_asociado')->references('idAdministrador')->on('administrador');
            $table->foreign('fid_secretario_academico')->references('idAdministrador')->on('administrador');
            $table->foreign('fid_horario')->references('idHorario')->on('horario'); // Clave foránea para la relación con horarios
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula_adicional');
    }
};
