<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alumno_riesgo', function (Blueprint $table) {
            $table->increments('idAlumnoRiesgo')->primary();
            $table->integer('fid_estudiante'); // Relación con la tabla estudiantes
            $table->integer('fid_semestre'); // Relación con la tabla semestres
            $table->timestamps();

            $table->foreign('fid_estudiante')->references('idEstudiante')->on('estudiante');
            $table->foreign('fid_semestre')->references('idSemestre')->on('semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_riesgo');
    }
};
