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
        Schema::create('tesis', function (Blueprint $table) {
            $table->increments('idTesis');
            $table->string('tema');
            $table->string('titulo');
            $table->string('resumen_tema');
            $table->timestamps();
        });

        Schema::create('tesis_autores', function (Blueprint $table) {
            $table->string('cod_estudiante');
            $table->unsignedInteger('fid_tesis');

            $table->foreign('cod_estudiante')->references('codEstudiante')->on('estudiante')->onDelete('cascade');
            $table->foreign('fid_tesis')->references('idTesis')->on('tesis')->onDelete('cascade');

            $table->primary(['cod_docente', 'fid_horario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tesis_autores');
        Schema::dropIfExists('tesis');
    }
};
