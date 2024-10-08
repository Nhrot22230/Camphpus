<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Usuarios\Administrador;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $administradores = Administrador::with('usuario')->get();

        Log::channel('administrador')->info('Listando Administradores', ['user_id' => Auth::id()]);

        return response()->json($administradores);
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
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'codAdmin' => 'required|string|unique:administrador,codAdmin|max:255',
            'fid_usuario' => 'required|exists:usuario,idUsuario|unique:administrador,fid_usuario',
        ]);

        // Crear el nuevo administrador con los datos validados
        $administrador = Administrador::create($validatedData);
        Log::channel('administrador')->info('Guardando Administrador', ['user_id' => Auth::id(), 'created_admin' => $administrador->codAdmin]);
        return response()->json($administrador, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $administrador = Administrador::with('usuario')->find($id);

        if (!$administrador) Log::channel('administrador')->info('Administrador no encontrado', ['user_id' => Auth::id()]);
        Log::channel('administrador')->info('Mostrando Administrador', ['user_id' => Auth::id(), 'showed_admin' => $administrador->codAdmin]);

        return response()->json($administrador);
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
    public function update(Request $request, string $id): JsonResponse
    {
        $validatedData = $request->validate([
            'codAdmin' => 'required|string|unique:administrador,codAdmin|max:255',
            'fid_usuario' => 'required|exists:usuario,idUsuario|unique:administrador,fid_usuario',
        ]);

        // Buscar el administrador y verificar si existe
        $administrador = Administrador::find($id);
        if (!$administrador)Log::channel('administrador')->info('Administrador no encontrado', ['user_id' => Auth::id()]);

        // Actualizar con los datos validados
        $administrador->update($validatedData);
        Log::channel('administrador')->info('Actualizado Administrador', ['user_id' => Auth::id(), 'updated_admin' => $administrador->codAdmin]);

        return response()->json($administrador);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $administrador = Administrador::find($id);
        if (!$administrador) Log::channel('administrador')->info('Administrador no encontrado', ['user_id' => Auth::id()]);

        // Eliminar el administrador
        $administrador->delete();

        Log::channel('administrador')->info('Administrador eliminado correctamente', ['user_id' => Auth::id(), 'deleted_admin' => $administrador->codAdmin]);
    }
}
