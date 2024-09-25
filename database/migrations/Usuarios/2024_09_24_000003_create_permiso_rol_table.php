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
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->unsignedInteger('permiso_id');
            $table->unsignedInteger('rol_id');

            $table->foreign('permiso_id')->references('idPermiso')->on('permiso')->onDelete('cascade');
            $table->foreign('rol_id')->references('idRol')->on('rol')->onDelete('cascade');

            $table->primary(['permiso_id', 'rol_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_rol');
    }
};
