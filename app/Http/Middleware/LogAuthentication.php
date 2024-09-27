<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Intentamos autenticar el usuario usando el token JWT
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            // Log del usuario autenticado
            Log::channel('usuarios')->info('Usuario autenticado', ['user_id' => $user->idUsuario, 'email' => $user->correo]);

        } catch (\Exception $e) {
            // Log del error de autenticación
            Log::channel('usuarios')->error('Error en autenticación JWT', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Token inválido o ausente'], 401);
        }

        return $next($request);
    }
}
