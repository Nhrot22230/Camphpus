<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class Usuario extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $usuarios = Usuario::with(['estudiante', 'docente', 'administrador'])->get();
        return response()->json($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'nullable|string|max:20|unique:usuario,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuario,correo',
            'password' => 'nullable|string|min:8', // La contraseña es opcional (por OAuth2)
            'external_id' => 'nullable|string|max:255|unique:usuario,external_id',
            'external_auth' => 'nullable|string|max:50',
            'avatar' => 'nullable|string',
            'estado' => 'boolean',
        ]);

        // Crear el usuario con los datos validados
        $usuario = Usuario::create(array_merge($validatedData, [
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : null,
        ]));

        return response()->json(['message' => 'Usuario creado exitosamente', 'usuario' => $usuario], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::with(['estudiante', 'docente', 'administrador'])->find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'dni' => 'nullable|string|max:20|unique:usuario,dni,' . $id . ',idUsuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuario,correo,' . $id . ',idUsuario',
            'password' => 'nullable|string|min:8',
            'external_id' => 'nullable|string|max:255|unique:usuario,external_id,' . $id . ',idUsuario',
            'external_auth' => 'nullable|string|max:50',
            'avatar' => 'nullable|string',
            'estado' => 'boolean',
        ]);

        // Buscar el usuario por su ID y verificar si existe
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Actualizar los datos del usuario
        $usuario->update(array_merge($validatedData, [
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $usuario->password,
        ]));

        return response()->json(['message' => 'Usuario actualizado exitosamente', 'usuario' => $usuario]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Eliminar el usuario
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente']);
    }
}
