<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Estudiante extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::with('usuario')->get();
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
    public function store(Request $request)
    {
        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_Horario' => 'nullable|exists:horario,idHorario',
        ]);

        $estudiante = Estudiante::create([
            'fid_usuario' => $request->fid_usuario,
            'fid_Horario' => $request->fid_Horario,
        ]);

        return response()->json(['message' => 'Estudiante creado exitosamente', 'estudiante' => $estudiante], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::with('usuario')->find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
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
    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $request->validate([
            'fid_usuario' => 'required|exists:usuario,idUsuario',
            'fid_Horario' => 'nullable|exists:horario,idHorario',
        ]);

        $estudiante->update([
            'fid_usuario' => $request->fid_usuario,
            'fid_Horario' => $request->fid_Horario,
        ]);

        return response()->json(['message' => 'Estudiante actualizado exitosamente', 'estudiante' => $estudiante], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado exitosamente'], 200);
    }
}
