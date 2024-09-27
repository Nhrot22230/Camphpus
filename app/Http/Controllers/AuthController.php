<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios\Usuario;
use Illuminate\Auth\Events\Login;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Registro de un nuevo usuario.
     *
     * Este método valida la solicitud de registro, crea un nuevo usuario en la base de datos
     * y devuelve un token JWT junto con los datos del usuario.
     *
     * @param Request $request La solicitud HTTP que contiene los datos del usuario.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el usuario creado o los errores de validación.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|string|max:10|unique:usuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuario',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Log::channel('authentication')->info('Intentando registrar nuevo usuario', [
            'dni' => $request->dni,
            'correo' => $request->correo,
        ]);

        try {
            $usuario = Usuario::create([
                'dni' => $validatedData['dni'],
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'correo' => $validatedData['correo'],
                'password' => $validatedData['password'],
                'estado' => true,
            ]);

            $token = JWTAuth::fromUser($usuario);

            Log::channel('authentication')->info('Usuario registrado exitosamente', ['usuario_id' => $usuario->idUsuario]);

            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'user' => $usuario,
                'token' => $token,
            ], 201);

        } catch (\Exception $e) {
            Log::channel('authentication')->error('Error al registrar el usuario', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Error al registrar el usuario',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Iniciar sesión y obtener un token JWT.
     *
     * Este método valida las credenciales del usuario y genera un token JWT si el inicio de sesión es exitoso.
     *
     * @param Request $request La solicitud HTTP que contiene las credenciales del usuario (correo y contraseña).
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el token JWT o los errores de autenticación.
     */
    public function login(Request $request)
    {
        Log::channel('authentication')->info('Intentando iniciar sesión', ['correo' => $request->correo]);

        $credentials = $request->only('correo', 'password');
        $user = Usuario::where('correo', $credentials['correo'])->first();

        if (!$user) {
            Log::channel('authentication')->warning('Usuario no encontrado', ['correo' => $request->correo]);
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            Log::channel('authentication')->warning('Contraseña incorrecta', ['usuario_id' => $user->idUsuario]);
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        try {
            $token = JWTAuth::fromUser($user);
            Log::channel('authentication')->info('Inicio de sesión exitoso', ['usuario_id' => $user->idUsuario]);
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'token' => $token,
            ], 200);
        } catch (JWTException $e) {
            Log::channel('authentication')->error('Error al generar el token JWT', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    }

    /**
     * Cerrar sesión (invalidar el token JWT).
     *
     * Este método invalida el token JWT actual, cerrando la sesión del usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON indicando el éxito o fallo al cerrar la sesión.
     */
    public function logout()
    {
        Log::channel('authentication')->info('Intentando cerrar sesión');
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                Log::channel('authentication')->warning('No se pudo obtener el token para cerrar sesión');
                return response()->json(['error' => 'No se pudo obtener el token'], 400);
            }
            JWTAuth::invalidate($token);

            Log::channel('authentication')->info('Sesión cerrada correctamente', ['token' => $token]);
            return response()->json(['message' => 'Sesión cerrada correctamente'], 200);

        } catch (TokenInvalidException $e) {
            Log::channel('authentication')->error('Token inválido al cerrar sesión', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'El token es inválido'], 400); // Código 400 para token inválido

        } catch (JWTException $e) {
            Log::channel('authentication')->error('Error al cerrar sesión (invalidar el token)', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'No se pudo cerrar la sesión'], 500);
        }
    }



    /**
     * Obtener los datos del usuario autenticado.
     *
     * Este método devuelve la información del usuario autenticado basado en el token JWT.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con los datos del usuario autenticado.
     */
    public function me()
    {
        try {
            $usuario = JWTAuth::parseToken()->authenticate();
            if (!$usuario) {
                Log::channel('authentication')->warning('Usuario no autenticado');
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }
            Log::channel('authentication')->info('Datos del usuario autenticado obtenidos', ['usuario_id' => $usuario->idUsuario]);
            return response()->json($usuario, 200);
        } catch (TokenExpiredException $e) {
            Log::channel('authentication')->warning('El token ha expirado', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'El token ha expirado'], 401);
        } catch (TokenInvalidException $e) {
            Log::channel('authentication')->error('Token inválido', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'El token es inválido'], 401);
        } catch (JWTException $e) {
            Log::channel('authentication')->error('Error al obtener los datos del usuario autenticado', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'No se pudo obtener el token'], 500);
        }
    }



    /**
     * Actualizar el token JWT.
     *
     * Este método genera un nuevo token JWT basado en el token actual del usuario.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el nuevo token o un mensaje de error.
     */
    public function refresh()
    {
        try {
            $token = JWTAuth::getToken();
            
            if (!$token) {
                Log::channel('authentication')->warning('No se pudo obtener el token para actualizar');
                return response()->json(['error' => 'Token no proporcionado'], 400); // Solicitud inválida
            }

            $newToken = JWTAuth::refresh($token);

            Log::channel('authentication')->info('Token actualizado exitosamente', ['token' => $newToken]);
            return response()->json([
                'message' => 'Token actualizado exitosamente',
                'token' => $newToken,
            ], 200);

        } catch (TokenExpiredException $e) {
            Log::channel('authentication')->warning('El token ha expirado y no se pudo refrescar', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'El token ha expirado y no se puede refrescar'], 401);

        } catch (TokenInvalidException $e) {
            Log::channel('authentication')->error('Token inválido al intentar refrescar', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'El token es inválido'], 401);

        } catch (JWTException $e) {
            Log::channel('authentication')->error('Error inesperado al intentar refrescar el token', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'No se pudo actualizar el token'], 500);
        }
    }

}
