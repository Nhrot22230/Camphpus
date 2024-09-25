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
        Schema::create('horario', function (Blueprint $table) {
            $table->increments('idHorario');
            $table->unsignedInteger('fid_curso');
            $table->unsignedInteger('fid_semestre');
            $table->string('codigo');
            $table->unsignedInteger('vacantes');
        });

        Schema::create('curso_horario', function (Blueprint $table) {
            $table->unsignedInteger('fid_curso');
            $table->unsignedInteger('fid_horario');

            $table->foreign('fid_curso')->references('idCurso')->on('curso')->onDelete('cascade');
            $table->foreign('fid_horario')->references('idHorario')->on('horario')->onDelete('cascade');

            $table->primary(['fid_curso', 'fid_horario']);
        });

        Schema::create('docente_horario', function (Blueprint $table) {
            $table->integer('cod_docente');
            $table->unsignedInteger('fid_horario');

            $table->foreign('cod_docente')->references('codDocente')->on('docente')->onDelete('cascade');
            $table->foreign('fid_horario')->references('idHorario')->on('horario')->onDelete('cascade');

            $table->primary(['cod_docente', 'fid_horario']);
        });

        Schema::create('estudiante_horario', function (Blueprint $table) {
            $table->integer('cod_estudiante');
            $table->unsignedInteger('fid_horario');

            $table->foreign('cod_estudiante')->references('codEstudiante')->on('estudiante')->onDelete('cascade');
            $table->foreign('fid_horario')->references('idHorario')->on('horario')->onDelete('cascade');

            $table->primary(['cod_estudiante', 'fid_horario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_horario');
        Schema::dropIfExists('docente_horario');
        Schema::dropIfExists('curso_horario');
        Schema::dropIfExists('horario');
    }
};
