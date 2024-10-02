<?php

namespace App\Http\Controllers;

use App\Models\Usuarios\Usuario;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class OAuthController extends Controller
{
    public function redirectToProvider()
    {
        Log::channel('authentication')->info('Redirigiendo al proveedor de Google para autenticación.');
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            Log::channel('authentication')->info('Recibiendo respuesta del proveedor Google.');
            $user = Socialite::driver('google')->user();
            Log::channel('authentication')->info('Datos del usuario recibidos de Google.', ['google_user' => $user]);


            $usuario = Usuario::firstOrCreate(
                [
                    'external_id' => $user->getId(),
                    'external_auth' => 'google',
                ],
                [
                    'nombre' => $user->getName(),
                    'correo' => $user->getEmail(),
                    'avatar' => $user->getAvatar(),
                    'password' => bcrypt('password_fake'),
                ]
            );

            Log::channel('authentication')->info('Usuario creado o encontrado en la base de datos.', ['usuario' => $usuario]);
            $token = JWTAuth::fromUser($usuario);
            Log::channel('authentication')->info('Token JWT generado.', ['token' => $token]);
            return redirect(env('FRONTEND_URL') . '/?token=' . $token);
        } catch (\Exception $e) {
            Log::channel('authentication')->error('Error durante el proceso de autenticación.', ['error' => $e->getMessage()]);
            return redirect(env('FRONTEND_URL') . '/?error=authentication_error');
        }
    }
}
