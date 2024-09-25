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
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('usuario_id');

            $table->foreign('rol_id')->references('idRol')->on('rol')->onDelete('cascade');
            $table->foreign('usuario_id')->references('idUsuario')->on('usuario')->onDelete('cascade');

            $table->primary(['rol_id', 'usuario_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('rol_usuario');
    }
};
