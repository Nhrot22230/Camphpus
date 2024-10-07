<?php

namespace App\Http\Controllers\Universidad;

use App\Models\Universidad\Departamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $departamentos = Departamento::with(['secciones', 'facultades'])->get();

        Log::channel('departamento')->info('Listando Departamentos', ['user_id' => Auth::id()]);

        return response()->json($departamentos);
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
            'estado' => 'required|boolean',
        ]);

        $departamento = Departamento::create($validatedData);
        Log::channel('departamento')->info('Guardando Departamento', ['user_id' => Auth::id(), 'created_departamento' => $departamento->idDepartamento]);
        return response()->json($departamento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $departamento = Departamento::with(['secciones', 'facultades'])->find($id);

        if (!$departamento) Log::channel('departamento')->info('Departamento no encontrado', ['user_id' => Auth::id()]);
        Log::channel('departamento')->info('Mostrando Departamento', ['user_id' => Auth::id(), 'showed_departamento' => $departamento->idDepartamento]);

        return response()->json($departamento);
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
            'estado' => 'required|boolean',
        ]);

        // Buscar el departamento y verificar si existe
        $departamento = Departamento::find($id);
        if (!$departamento) Log::channel('departamento')->info('Departamento no encontrado', ['user_id' => Auth::id()]);
        // Actualizar con los datos validados
        $departamento->update($validatedData);

        Log::channel('departamento')->info('Actualizando Departamento', ['user_id' => Auth::id(), 'updated_departamento' => $departamento->idDepartamento]);

        return response()->json($departamento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $departamento = Departamento::find($id);
        if (!$departamento) Log::channel('departamento')->info('Departamento no encontrado', ['user_id' => Auth::id()]);

        // Eliminar el departamento
        $departamento->delete();

        Log::channel('departamento')->info('Departamento eliminado correctamente', ['user_id' => Auth::id(), 'deleted_departamento' => $departamento->idDpartamento]);

    }
}
