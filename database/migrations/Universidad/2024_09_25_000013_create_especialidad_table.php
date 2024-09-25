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
        Schema::create('especialidad', function (Blueprint $table) {
            $table->increments('idEspecialidad');
            $table->unsignedInteger('fid_facultad');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('fid_facultad')->references('idFacultad')->on('facultad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialidad');
    }
};
