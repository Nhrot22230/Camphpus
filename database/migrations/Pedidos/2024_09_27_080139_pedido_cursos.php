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
        Schema::create('pedido_curso', function (Blueprint $table) {
            $table->increments('idPedidoCurso'); // ID del pedido
            $table->boolean('aprobado')->default(false);
            $table->string('observaciones')->nullable();

            $table->unsignedInteger('fid_semestre'); // Semestre al que pertenece el pedido
            $table->unsignedInteger('fid_facultad'); // Facultad a la que pertenece el pedido
            $table->unsignedInteger('fid_especialidad'); // Especialidad relacionada

            // Timestamps
            $table->timestamps();

            // Definir las llaves foráneas en las migraciones
            $table->foreign('fid_semestre')->references('idSemestre')->on('semestre')->onDelete('cascade');
            $table->foreign('fid_facultad')->references('idFacultad')->on('facultad')->onDelete('cascade');
            $table->foreign('fid_especialidad')->references('idEspecialidad')->on('especialidad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_curso');
    }
};
