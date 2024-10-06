<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Usuarios\Estudiante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $estudiantes = Estudiante::with('usuario')->get();

        Log::channel('estudiante')->info('Listando Estudiantes', ['user_id' => Auth::id()]);

        return response()->json($estudiantes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_Horario' => 'nullable|exists:horario,idHorario',
        ]);

        $estudiante = Estudiante::create([
            'fid_usuario' => $request->fid_usuario,
            'fid_Horario' => $request->fid_Horario,
        ]);

        Log::channel('estudiante')->info('Guardando Estudiante', ['user_id' => Auth::id(), 'created_estudiante' => $estudiante->codEstudiante]);

        return response()->json(['message' => 'Estudiante creado exitosamente', 'estudiante' => $estudiante], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $estudiante = Estudiante::with('usuario')->find($id);

        if (!$estudiante) Log::channel('estudiante')->info('Estudiante no encontrado', ['user_id' => Auth::id()]);
        Log::channel('estudiante')->info('Mostrando Estudiante', ['user_id' => Auth::id(), 'showed_estudiante' => $estudiante->codEstudiante]);

        return response()->json($estudiante);
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
        $estudiante = Estudiante::find($id);

        if (!$estudiante) Log::channel('estudiante')->info('Estudiante no encontrado', ['user_id' => Auth::id()]);

        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_Horario' => 'nullable|exists:horario,idHorario',
        ]);

        $estudiante->update([
            'fid_usuario' => $request->fid_usuario,
            'fid_Horario' => $request->fid_Horario,
        ]);

        Log::channel('estudiante')->info('Actualizando Estudiante', ['user_id' => Auth::id(), 'updated_estudiante' => $estudiante->codEstudiante]);

        return response()->json($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) Log::channel('estudiante')->info('Estudiante no encontrado', ['user_id' => Auth::id()]);

        $estudiante->delete();

        Log::channel('estudiante')->info('Eliminando Estudiante', ['user_id' => Auth::id(), 'deleted_estudiante' => $estudiante->codEstudiante]);
    }
}
