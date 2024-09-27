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
        Schema::create('curso_plan_estudio', function (Blueprint $table) {
            $table->increments('idCursoPlanEstudio')->primary(); // ID del pedido
            $table->integer('nivel');

            $table->unsignedInteger('fid_curso');
            $table->unsignedInteger('fid_planEstudio');
            //$table->unsignedInteger('fid_pedidoCurso');

            // Timestamps
            $table->timestamps();

            // Definir las llaves foráneas en las migraciones
            $table->foreign('fid_curso')->references('idCurso')->on('curso')->onDelete('cascade');
            $table->foreign('fid_planEstudio')->references('idPlanEstudio')->on('plan_estudio')->onDelete('cascade');
            //$table->foreign('fid_pedidoCurso')->references('idPedidoCurso')->on('pedido_curso')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_plan_estudio');
    }
};
