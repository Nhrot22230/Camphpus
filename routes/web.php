<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/prueba', function () {
    return 'Ruta de prueba funcionando';
});

// Rutas públicas para Usuarios
Route::apiResource('api/usuarios', UsuariosController::class);

// O, si necesitas aplicar middleware:
// Route::middleware('auth:api')->apiResource('usuarios', UsuariosController::class);

