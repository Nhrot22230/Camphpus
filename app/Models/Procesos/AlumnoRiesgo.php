<?php

namespace App\Models\Procesos;

use App\Models\Universidad\CursoRiesgo;
use App\Models\Universidad\Semestre;
use App\Models\Usuarios\Estudiante;
use Illuminate\Database\Eloquent\Model;

class AlumnoRiesgo extends Model
{
    protected $table = 'alumno_riesgo';
    protected $primaryKey = 'idAlumnoRiesgo';
    public $incrementing = true;

    protected $fillable = [
        'fid_estudiante',
        'fid_semestre', // Clave foránea hacia la tabla 'semestres'
    ];

    // Relación con el estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'fid_estudiante', 'idEstudiante');
    }

    // Relación con el semestre
    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'fid_semestre', 'idSemestre');
    }

    // Relación con los cursos en riesgo (HasMany)
    public function cursosRiesgo()
    {
        //Significa que buscara en fid_alumnoRiesgo el id de la clase AlumnoRiesgo en la tabla curso_riesgo
        return $this->hasMany(CursoRiesgo::class, 'fid_alumnoRiesgo');
    }
}
