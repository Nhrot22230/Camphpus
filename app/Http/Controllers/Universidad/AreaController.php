<?php

namespace App\Http\Controllers\Universidad;

use App\Models\Universidad\Area;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $areas = Area::with(['especialidad'])->get();

        Log::channel('area')->info('Listando Áreas', ['user_id' => Auth::id()]);

        return response()->json($areas);
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
            'nombre' => 'required|string|max:255',
            'fid_especialidad' => 'required|exists:especialidad,idEspecialidad',
            'estado' => 'required|boolean',
        ]);

        $area = Area::create($validatedData);
        Log::channel('area')->info('Guardando Áreas', ['user_id' => Auth::id(), 'created_area' => $area->idArea]);
        return response()->json($area, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $area = Area::with(['facultad', 'areas', 'tesis'])->find($id);

        if (!$area) Log::channel('area')->info('Área no encontrada', ['user_id' => Auth::id()]);
        Log::channel('area')->info('Mostrando Área', ['user_id' => Auth::id(), 'showed_area' => $area->idArea]);

        return response()->json($area);
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
            'nombre' => 'required|string|max:255',
            'fid_especialidad' => 'required|exists:especialidad,idEspecialidad',
            'estado' => 'required|boolean',
        ]);

        // Buscar el área y verificar si existe
        $area = Area::find($id);
        if (!$area) Log::channel('area')->info('Área no encontrada', ['user_id' => Auth::id()]);
        // Actualizar con los datos validados
        $area->update($validatedData);

        Log::channel('area')->info('Actualizando Área', ['user_id' => Auth::id(), 'updated_area' => $area->idArea]);

        return response()->json($area);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $area = Area::find($id);
        if (!$area) Log::channel('area')->info('Área no encontrada', ['user_id' => Auth::id()]);

        // Eliminar las áreas
        $area->delete();

        Log::channel('area')->info('Área eliminada correctamente', ['user_id' => Auth::id(), 'deleted_area' => $area->idArea]);

    }
}
