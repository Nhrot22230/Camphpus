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
        Schema::create('seccion', function (Blueprint $table) {
            $table->increments('idSeccion');
            $table->unsignedInteger('fid_departamento');
            $table->string('cod_jefeSeccion');
            $table->timestamps();

            $table->foreign('fid_departamento')->references('idDepartamento')->on('departamento')->onDelete('cascade');
            $table->foreign('cod_jefeSeccion')->references('codDocente')->on('docente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seccion');
    }
};
