<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Usuarios\Docente;
use \App\Http\Controllers\Usuarios\Administrador;
use \App\Http\Controllers\Usuarios\Estudiante;

use \App\Http\Controllers\Universidad\Seccion;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar rutas API para tu aplicación. Estas rutas están
| dentro del grupo de middleware "api", lo que permite limitar la tasa de
| solicitudes y usar respuestas JSON por defecto.
|
*/

Route::apiResource('docentes', Docente::class);
Route::apiResource('estudiantes', Estudiante::class);
Route::apiResource('administrador', Administrador::class);
Route::apiResource('seccion', Seccion::class);

