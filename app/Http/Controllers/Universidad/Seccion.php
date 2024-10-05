<?php

namespace App\Http\Controllers\Universidad;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Seccion extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secciones = Seccion::with(['departamento', 'jefeSeccion', 'comites_evaluadores'])->get();
        return response()->json($secciones);
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
            'fid_departamento' => 'required|exists:departamento,idDepartamento',
            'cod_jefeSeccion' => 'required|exists:docente,codDocente',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $seccion = Seccion::create($validatedData);

        return response()->json(['message' => 'Sección creada exitosamente', 'seccion' => $seccion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seccion = Seccion::with(['departamento', 'jefeSeccion', 'comites_evaluadores'])->find($id);

        if (!$seccion) {
            return response()->json(['message' => 'Sección no encontrada'], 404);
        }

        return response()->json($seccion);
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
            'fid_departamento' => 'required|exists:departamento,idDepartamento',
            'cod_jefeSeccion' => 'required|exists:docente,codDocente',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        // Buscar la sección y verificar si existe
        $seccion = Seccion::find($id);
        if (!$seccion) {
            return response()->json(['message' => 'Sección no encontrada'], 404);
        }

        // Actualizar con los datos validados
        $seccion->update($validatedData);

        return response()->json(['message' => 'Sección actualizada exitosamente', 'seccion' => $seccion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seccion = Seccion::find($id);
        if (!$seccion) {
            return response()->json(['message' => 'Sección no encontrada'], 404);
        }

        // Eliminar la sección
        $seccion->delete();

        return response()->json(['message' => 'Sección eliminada exitosamente']);
    }
}
