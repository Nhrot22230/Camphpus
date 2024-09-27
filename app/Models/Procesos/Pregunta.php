<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'pregunta';
    protected $primaryKey = 'idPregunta';
    public $incrementing = true;

    protected $fillable = [
        'numPregunta',
        'texto',
        'respuesta',
        'fid_GrupoPregunta',
        'fid_RespuestaEncuesta',
    ];
    protected $casts = [
       'tipoPregunta'=>TipoPregunta::class,
    ];
    public function grupoPregunta()
    {
        return $this->belongsTo(GrupoPregunta::class, 'fid_GrupoPregunta', 'idGrupoPregunta');
    }
    public function respuestaEncuesta()
    {
        return $this->belongsTo(RespuestaEncuesta::class, 'fid_RespuestaEncuesta', 'idRespuestaEncuesta');
    }
}
