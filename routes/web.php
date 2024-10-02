<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;

Route::get('/auth/redirect/google', [OAuthController::class, 'redirectToProvider']);
Route::get('/auth/callback/google', [OAuthController::class, 'handleProviderCallback']);

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

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

Route::get('/hola', function () {
    return response()->json([
        'message' => 'Hola mundo'
    ]);
});
