<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Usuarios\Docente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::with(['usuario', 'horario', 'tesis', 'estudianteTesis', 'comiteEvaluador'])->get();
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

        return response()->json(['message' => 'Docente creado exitosamente', 'docente' => $docente], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docente = Docente::with(['usuario', 'horario', 'tesis', 'estudianteTesis', 'comiteEvaluador'])->find($id);

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

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

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

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

        return response()->json(['message' => 'Docente actualizado exitosamente', 'docente' => $docente], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $docente = Docente::find($id);

        if (!$docente) {
            return response()->json(['message' => 'Docente no encontrado'], 404);
        }

        $docente->delete();
        return response()->json(['message' => 'Docente eliminado exitosamente'], 200);
    }
}
