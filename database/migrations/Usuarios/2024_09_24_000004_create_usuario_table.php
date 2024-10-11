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
            $table->increments('idUsuario');
            $table->string('dni')->unique()->nullable(); // Puede ser null si solo se usa OAuth2
            $table->string('avatar')->nullable(); // Los datos podrían provenir de OAuth2
            $table->string('nombre')->nullable(); // Los datos podrían provenir de OAuth2
            $table->string('apellido')->nullable(); // Los datos podrían provenir de OAuth2
            $table->string('correo')->unique(); // El correo será único en cualquier caso
            $table->string('password')->nullable(); // No requerido si se usa OAuth2
            $table->string('external_id')->nullable(); // ID del usuario en el proveedor OAuth2
            $table->string('external_auth')->nullable(); // Proveedor OAuth2 (ej: google, facebook)
            $table->boolean('estado')->default(true);
            $table->rememberToken()->nullable();
            $table->timestamps();
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
