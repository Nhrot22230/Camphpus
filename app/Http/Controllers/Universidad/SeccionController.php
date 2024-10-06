<?php

namespace App\Http\Controllers\Universidad;

use App\Models\Universidad\Seccion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $secciones = Seccion::with(['departamento', 'jefeSeccion', 'comites_evaluadores'])->get();

        Log::channel('seccion')->info('Listando Secciones', ['user_id' => Auth::id()]);

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
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'fid_departamento' => 'required|exists:departamento,idDepartamento',
            'cod_jefeSeccion' => 'required|exists:docente,codDocente',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $seccion = Seccion::create($validatedData);
        Log::channel('seccion')->info('Guardando Seccion', ['user_id' => Auth::id(), 'created_seccion' => $seccion->idSeccion]);
        return response()->json($seccion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $seccion = Seccion::with(['departamento', 'jefeSeccion', 'comites_evaluadores'])->find($id);

        if (!$seccion) Log::channel('seccion')->info('Seccion no encontrada', ['user_id' => Auth::id()]);
        Log::channel('seccion')->info('Mostrando Seccion', ['user_id' => Auth::id(), 'showed_seccion' => $seccion->idSeccion]);

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
    public function update(Request $request, string $id): JsonResponse
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
        if (!$seccion) Log::channel('seccion')->info('Seccion no encontrada', ['user_id' => Auth::id()]);

        // Actualizar con los datos validados
        $seccion->update($validatedData);

        Log::channel('seccion')->info('Actualizada Seccion', ['user_id' => Auth::id(), 'updated_seccion' => $seccion->idSeccion]);

        return response()->json($seccion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $seccion = Seccion::find($id);
        if (!$seccion) Log::channel('seccion')->info('Seccion no encontrada', ['user_id' => Auth::id()]);

        // Eliminar la sección
        $seccion->delete();

        Log::channel('seccion')->info('Seccion eliminada correctamente', ['user_id' => Auth::id(), 'deleted_seccion' => $seccion->idSeccion]);

    }
}
