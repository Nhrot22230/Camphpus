<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Usuarios\Docente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $docentes = Docente::with(['usuario', 'horario', 'tesis', 'estudianteTesis', 'comiteEvaluador'])->get();

        Log::channel('docente')->info('Listando Docentes', ['user_id' => Auth::id()]);

        return response()->json($docentes);
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
    public function store(Request $request)
    {
        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_horario' => 'nullable|exists:horario,idHorario',
            'fid_comite_evaluador' => 'nullable|exists:comite_evaluador,idComiteEvaluador',
            // Agregar otras validaciones específicas para atributos adicionales
        ]);

        $docente = Docente::create([
            'fid_usuario' => $request->fid_usuario,
            'fid_horario' => $request->fid_horario,
            'fid_comite_evaluador' => $request->fid_comite_evaluador,
            // Otros atributos específicos de Docente
        ]);

        Log::channel('docente')->info('Guardando Docente', ['user_id' => Auth::id(), 'created_docente' => $docente->idDocente]);

        return response()->json($docente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $docente = Docente::with(['usuario', 'horario', 'tesis', 'estudianteTesis', 'comiteEvaluador'])->find($id);

        if (!$docente) Log::channel('docente')->info('Estudiante no encontrado', ['user_id' => Auth::id()]);
        Log::channel('docente')->info('Mostrando Docente', ['user_id' => Auth::id(), 'showed_docente' => $docente->idDocente]);

        return response()->json($docente);
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
        $docente = Docente::find($id);

        if (!$docente) Log::channel('docente')->info('Docente no encontrado', ['user_id' => Auth::id()]);

        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_horario' => 'nullable|exists:horario,idHorario',
            'fid_comite_evaluador' => 'nullable|exists:comite_evaluador,idComiteEvaluador',
            // Validar otros atributos específicos de Docente
        ]);

        $docente->update([
            'fid_usuario' => $request->fid_usuario,
            'fid_horario' => $request->fid_horario,
            'fid_comite_evaluador' => $request->fid_comite_evaluador,
            // Otros atributos específicos de Docente
        ]);

        Log::channel('docente')->info('Actualizando Docente', ['user_id' => Auth::id(), 'updated_docente' => $docente->idDocente]);

        return response()->json($docente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
         $docente = Docente::find($id);

        if (!$docente) Log::channel('docente')->info('Docente no encontrado', ['user_id' => Auth::id()]);

        $docente->delete();

        Log::channel('docente')->info('Eliminando Docente', ['user_id' => Auth::id(), 'deleted_docente' => $docente->idDocente]);
    }
}
