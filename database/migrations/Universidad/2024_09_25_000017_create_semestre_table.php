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
        Schema::create('semestre', function (Blueprint $table) {
            $table->increments('idSemestre');
            $table->unsignedInteger('anho');
            $table->unsignedInteger('periodo');
            $table->tinyInteger('estado');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestre');
    }
};
