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
        Schema::create('area', function (Blueprint $table) {
            $table->increments('idArea');
            $table->unsignedInteger('fid_especialidad');
            $table->string('nombre');
            $table->tinyInteger('estado');
            $table->timestamps();

            $table->foreign('fid_especialidad')->references('idEspecialidad')->on('especialidad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area');
    }
};
