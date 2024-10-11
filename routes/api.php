<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Universidad\AreaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Usuarios\DocenteController;
use \App\Http\Controllers\Usuarios\AdministradorController;
use \App\Http\Controllers\Usuarios\EstudianteController;
use \App\Http\Controllers\UsuariosController;

use \App\Http\Controllers\Universidad\SeccionController;
use \App\Http\Controllers\Universidad\DepartamentoController;
use App\Http\Controllers\Universidad\EspecialidadController;
use App\Http\Controllers\Universidad\FacultadController;

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

Route::apiResource('docentes', DocenteController::class);
Route::apiResource('estudiantes', EstudianteController::class);
Route::apiResource('administrador', AdministradorController::class);
Route::apiResource('seccion', SeccionController::class);
Route::apiResource('usuarios', UsuariosController::class);
Route::apiResource('departamentos', DepartamentoController::class);
Route::apiResource('facultades', FacultadController::class);
Route::apiResource('especialidades', EspecialidadController::class);
Route::apiResource('areas', AreaController::class);
