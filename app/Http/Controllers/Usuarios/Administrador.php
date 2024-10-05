<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Administrador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administradores = Administrador::with('usuario')->get();
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            // Validar otros atributos específicos de Administrador según sea necesario
        ]);

        // Crear el nuevo administrador con los datos validados
        $administrador = Administrador::create($validatedData);

        return response()->json(['message' => 'Administrador creado exitosamente', 'administrador' => $administrador], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $administrador = Administrador::with('usuario')->find($id);

        if (!$administrador) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        }

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
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            // Validar otros atributos específicos de Administrador según sea necesario
        ]);

        // Buscar el administrador y verificar si existe
        $administrador = Administrador::find($id);
        if (!$administrador) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        }

        // Actualizar con los datos validados
        $administrador->update($validatedData);

        return response()->json(['message' => 'Administrador actualizado exitosamente', 'administrador' => $administrador]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrador = Administrador::find($id);
        if (!$administrador) {
            return response()->json(['message' => 'Administrador no encontrado'], 404);
        }

        // Eliminar el administrador
        $administrador->delete();

        return response()->json(['message' => 'Administrador eliminado exitosamente']);
    }
}
