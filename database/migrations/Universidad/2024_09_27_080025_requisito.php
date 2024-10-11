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
        Schema::create('requisito', function (Blueprint $table) {
            $table->increments('idRequisito'); // ID del pedido
            $table->string('tipo_requisito');
            $table->string('codigo_creditos');

            $table->unsignedInteger('fid_cursoPlanEstudio');

            // Timestamps
            $table->timestamps();

            // Definir las llaves foráneas en las migraciones
            $table->foreign('fid_cursoPlanEstudio')->references('idCursoPlanEstudio')->on('curso_plan_estudio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisito');
    }
};
