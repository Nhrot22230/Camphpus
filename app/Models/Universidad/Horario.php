<?php

namespace App\Models\Universidad;

use App\Models\Procesos\RespuestaEncuesta;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Docente;
use App\Models\Usuarios\Estudiante;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'idHorario';
    public $incrementing = true;

    protected $fillable = [
        'fid_Curso',
        'fid_semestre',
        'fid_RespuestaEncuesta',
        'codigo',
        'vacantes',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_Curso', 'idCurso');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'fid_Semestre', 'idSemestre');
    }

    public function docente()
    {
        return $this->hasMany(Docente::class, 'fid_Docente', 'idDocente', 'docente_id');
    }

    public function estudiante()
    {
        return $this->hasMany(Estudiante::class, 'fid_Horario', 'idHorario');
    }
    public function delegado()
    {
        return $this->hasOne(Estudiante::class, 'fid_Horario','idHorario');
    }
    public function jefePractica()
    {
        return $this->hasOne(Usuario::class, 'fid_Horario','idHorario');
    }
    public function respuestaEncuesta()
    {
        return $this->belongsTo(RespuestaEncuesta::class, 'fid_RespuestaEncuesta', 'idRespuestaEncuesta');
    }
}
