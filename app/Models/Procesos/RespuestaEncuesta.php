<?php

namespace App\Models\Procesos;

use App\Models\Universidad\Curso;
use App\Models\Universidad\Horario;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Model;

class RespuestaEncuesta extends Model
{
    protected $table = 'respuestaPregunta';
    protected $primaryKey = 'idRespuestaPregunta';
    public $incrementing = true;

    protected $fillable = [
        'puntaje',
        'fid_Horario',
        'fid_Curso',
        'fid_Usuario',
    ];

    public function horario()
    {
        return $this->hasOne(Horario::class, 'fid_RespuestaEncuesta', 'idRespuestaPregunta');
    }
    public function curso()
    {
        return $this->hasOne(Curso::class, 'fid_RespuestaEncuesta', 'idRespuestaPregunta');
    }
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'fid_RespuestaEncuesta', 'idRespuestaPregunta');
    }
    public function pregunta()
    {
        return $this->hasMany(Pregunta::class, 'fid_RespuestaEncuesta', 'idRespuestaPregunta');
    }
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'fid_Encuesta', 'idEncuesta');
    }

}
