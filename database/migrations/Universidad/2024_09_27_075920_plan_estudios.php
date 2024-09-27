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
        Schema::create('plan_estudios', function (Blueprint $table) {
            $table->increments('idPlanEstudios')->primary();
            $table->integer('numeroNiveles');
            $table->date('fechaCreacion');
            $table->date('fechaModificacion');

            $table->integer('fid_especialidad');
            $table->timestamps();

            $table->foreign('fid_especialidad')->references('idEspecialidad')->on('especialidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_estudios');
    }
};
