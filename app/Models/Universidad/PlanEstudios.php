<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class PlanEstudios extends Model
{
    protected $table = 'plan_estudios';
    protected $primaryKey = 'idPlanEstudios';
    public $incrementing = true;

    protected $fillable = [
        'fechaCreacion',
        'numeroNiveles',
        'fechaModificacion',
        'fid_especialidad',
        'fid_curso',
        'fid_cursoPlanEstudio'
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'fid_especialiad', 'idEspecialidad');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'fid_curso', 'idCurso');
    }

    public function cursoPlanEstudio()
    {
        return $this->hasMany(CursoPlanEstudio::class, 'fid_cursoPlanEstudio', 'idCursoPlanEstudio');
    }
}
