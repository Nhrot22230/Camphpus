<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;

Route::get('/auth/redirect/google', [OAuthController::class, 'redirectToProvider']);
Route::get('/auth/callback/google', [OAuthController::class, 'handleProviderCallback']);


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

Route::get('/home', function () {
    return view('home');
});

