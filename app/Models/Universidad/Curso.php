<?php

namespace App\Models\Universidad;

use App\Models\Procesos\RespuestaEncuesta;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'idCurso';
    public $incrementing = true;

    protected $fillable = [
        'fid_especialidad',
        'fid_RespuestaEncuesta',
        'cod_curso',
        'nombre',
        'creditos',
        'estado',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
    public function respuestaEncuesta()
    {
        return $this->belongsTo(RespuestaEncuesta::class,'fid_RespuestaEncuesta','idRespuestaEncuesta');
    }
    public function horario()
    {
        return $this->hasMany(Horario::class,'fid_Curso','idCurso');
    }
}
