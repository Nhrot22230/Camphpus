<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas rutas
| reciben el middleware "web" que proporciona características como el
| manejo de sesiones, la protección contra CSRF, etc.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Bienvenido a web.php';
});

Route::post('/login', function () {
    return 'Bienvenido a web.php';
});
    