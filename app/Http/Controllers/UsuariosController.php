<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Registrar los datos recibidos en el log usando el canal 'usuarios'
        Log::channel('usuarios')->info('Datos recibidos en store:', $request->all());

        $validatedData = $request->validate([
            'dni' => 'required|unique:usuario,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:8',
            'estado' => 'required|boolean',
        ]);

        // Registrar los datos validados
        Log::channel('usuarios')->info('Datos validados:', $validatedData);
        $usuario = Usuario::create($validatedData);
        Log::channel('usuarios')->info('Usuario creado:', $usuario->toArray());

        if ($usuario) {
            return response()->json($usuario, 201);
        }

        return response()->json(['message' => 'Error al crear el usuario'], 500);
    }


    /**
     * Muestra un usuario específico.
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $validatedData = $request->validate([
            'dni' => 'required|unique:usuario,dni,' . $id . ',idUsuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuario,correo,' . $id . ',idUsuario',
            'estado' => 'required|boolean',
        ]);

        $usuario->update($validatedData);

        return response()->json($usuario);
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(null, 204);
    }
}
