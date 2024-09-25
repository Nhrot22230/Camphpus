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
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idUsuario')->primary();
            $table->string('dni')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('password');
            $table->boolean('estado')->default(true);
            $table->rememberToken();
            $table->timestamps();
            // Otros campos necesarios
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};
