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
            $table->increments('idSeccion')->primary(); // Llave primaria con auto-incremento
            $table->integer('fid_departamento'); // Llave foránea hacia `departamento`
            $table->string('cod_jefeSeccion'); // Llave foránea hacia `docente`, puede ser null
            $table->string('nombre'); // Nombre de la sección
            $table->text('descripcion')->nullable(); // Descripción de la sección (opcional)
            $table->boolean('estado')->default(true); // Estado de la sección
            $table->timestamps(); // Timestamps para `created_at` y `updated_at`

            // Definición de llaves foráneas
            $table->foreign('fid_departamento')
                ->references('idDepartamento')
                ->on('departamento')
                ->onDelete('cascade');

            $table->foreign('cod_jefeSeccion')
                ->references('codDocente')
                ->on('docente')
                ->onDelete('cascade');
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
