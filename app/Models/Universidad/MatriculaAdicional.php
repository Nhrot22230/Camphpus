<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class MatriculaAdicional extends Model
{
    protected $table = 'matricula_adicional';
    protected $primaryKey = 'idMatriculaAdicional';
    public $incrementing = true;

    protected $fillable = [
        'fid_estudiante',
        'fid_curso',
        'fid_director_asociado',
        'fid_secretario_academico',
        'fid_horario',
        'motivo',
        'justificacion',
        'semestre',
        'etapa_matricula_adicional',
        'activo',
    ];

    // Definir las relaciones con el estándar fid_
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'fid_horario', 'idHorario');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'fid_estudiante', 'idEstudiante');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_curso', 'idCurso');
    }

    public function directorAsociado()
    {
        return $this->belongsTo(Administrativo::class, 'fid_director_asociado', 'idAdministrativo');
    }

    public function secretarioAcademico()
    {
        return $this->belongsTo(Administrativo::class, 'fid_secretario_academico', 'idAdministrativo');
    }
}
