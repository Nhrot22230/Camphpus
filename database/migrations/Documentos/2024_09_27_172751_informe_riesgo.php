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
        Schema::create('informe_riesgo', function (Blueprint $table) {
            $table->increments('idInformeRiesgo');
            $table->integer('semana');
            $table->date('fechainicio');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado']);
            $table->integer('fid_semestre');
            $table->timestamps();

            // Definir clave foránea con el estándar fid_nombre
            $table->foreign('fid_semestre')->references('idSemestre')->on('semestre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe_riesgo');
    }
};
