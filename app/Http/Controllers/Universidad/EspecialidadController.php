<?php

namespace App\Http\Controllers\Universidad;

use App\Models\Universidad\Especialidad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $especialidades = Especialidad::with(['facultad', 'areas', 'tesis'])->get();

        Log::channel('especialidad')->info('Listando Especialidades', ['user_id' => Auth::id()]);

        return response()->json($especialidades);
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
            'fid_facultad' => 'required|exists:facultad,idFacultad',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $especialidad = Especialidad::create($validatedData);
        Log::channel('especialidad')->info('Guardando Especialidad', ['user_id' => Auth::id(), 'created_especialidad' => $especialidad->idEspecialidad]);
        return response()->json($especialidad, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $especialidad = Especialidad::with(['facultad', 'areas', 'tesis'])->find($id);

        if (!$especialidad) Log::channel('especialidad')->info('Especialidad no encontrada', ['user_id' => Auth::id()]);
        Log::channel('especialidad')->info('Mostrando Especialidad', ['user_id' => Auth::id(), 'showed_especialidad' => $especialidad->idEspecialidad]);

        return response()->json($especialidad);
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
            'fid_facultad' => 'required|exists:facultad,idFacultad',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        // Buscar la especialidad y verificar si existe
        $especialidad = Especialidad::find($id);
        if (!$especialidad) Log::channel('especialidad')->info('Especialidad no encontrada', ['user_id' => Auth::id()]);
        // Actualizar con los datos validados
        $especialidad->update($validatedData);

        Log::channel('especialidad')->info('Actualizando Especialidad', ['user_id' => Auth::id(), 'updated_especialidad' => $especialidad->idEspecialidad]);

        return response()->json($especialidad);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $especialidad = Especialidad::find($id);
        if (!$especialidad) Log::channel('especialidad')->info('Especialidad no encontrada', ['user_id' => Auth::id()]);

        // Eliminar la especialidad
        $especialidad->delete();

        Log::channel('especialidad')->info('Especialidad eliminada correctamente', ['user_id' => Auth::id(), 'deleted_especialidad' => $especialidad->idEspecialidad]);

    }
}
