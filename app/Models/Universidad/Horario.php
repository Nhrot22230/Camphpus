<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Docente;
use App\Models\Usuarios\Estudiante;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'idHorario';
    public $incrementing = true;

    protected $fillable = [
        'fid_curso',
        'fid_semestre',
        'codigo',
        'vacantes',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_curso', 'idCurso');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'fid_semestre', 'idSemestre');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'horario_docente', 'horario_id', 'docente_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'horario_estudiante', 'horario_id', 'estudiante_id');
    }
}