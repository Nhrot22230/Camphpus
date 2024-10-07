<?php

namespace App\Http\Controllers\Universidad;

use App\Models\Universidad\Facultad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $facultades = Facultad::with(['departamento', 'especialidades'])->get();

        Log::channel('facultad')->info('Listando Facultades', ['user_id' => Auth::id()]);

        return response()->json($facultades);
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
            'fid_departamento' => 'required|exists:departamento,idDepartamento',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $facultad = Facultad::create($validatedData);
        Log::channel('facultad')->info('Guardando Facultad', ['user_id' => Auth::id(), 'created_facultad' => $facultad->idFacultad]);
        return response()->json($facultad, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $facultad = Facultad::with(['departamento', 'especialidades'])->find($id);

        if (!$facultad) Log::channel('facultad')->info('Facultad no encontrada', ['user_id' => Auth::id()]);
        Log::channel('facultad')->info('Mostrando Facultad', ['user_id' => Auth::id(), 'showed_facultad' => $facultad->idFacultad]);

        return response()->json($facultad);
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
            'fid_departamento' => 'required|exists:departamento,idDepartamento',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        // Buscar la facultad y verificar si existe
        $facultad = Facultad::find($id);
        if (!$facultad) Log::channel('facultad')->info('Facultad no encontrada', ['user_id' => Auth::id()]);

        // Actualizar con los datos validados
        $facultad->update($validatedData);

        Log::channel('facultad')->info('Actualizando Facultad', ['user_id' => Auth::id(), 'updated_facultad' => $facultad->idFacultad]);

        return response()->json($facultad);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $facultad = Facultad::find($id);
        if (!$facultad) Log::channel('facultad')->info('Facultad no encontrada', ['user_id' => Auth::id()]);

        // Eliminar la facultad
        $facultad->delete();

        Log::channel('facultad')->info('Facultad eliminada correctamente', ['user_id' => Auth::id(), 'deleted_facultad' => $facultad->idFacultad]);

    }
}
