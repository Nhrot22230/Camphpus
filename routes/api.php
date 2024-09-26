<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

// Ruta que devuelve 'world' al acceder a '/api/hello'
Route::get('/hello', function () {
    return 'world';
});

// Rutas públicas para Usuarios
Route::apiResource('usuarios', UsuariosController::class);

// O, si necesitas aplicar middleware:
// Route::middleware('auth:api')->apiResource('usuarios', UsuariosController::class);
