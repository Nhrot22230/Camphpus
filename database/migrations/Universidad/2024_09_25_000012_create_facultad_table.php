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
        Schema::create('facultad', function (Blueprint $table) {
            $table->increments('idFacultad');
            $table->unsignedInteger('fid_departamento');
            $table->string('nombre');
            $table->tinyInteger('estado');
            $table->timestamps();

            $table->foreign('fid_departamento')->references('idDepartamento')->on('departamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facultad');
    }
};
