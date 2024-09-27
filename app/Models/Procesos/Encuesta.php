<?php

namespace App\Models\Procesos;
use App\Models\Universidad\Horario;
use App\Models\Universidad\Semestre;
use Illuminate\Database\Eloquent\Model;
class Encuesta extends Model
{
    protected $table = 'encuesta';
    protected $primaryKey = 'idEncuesta';
    public $incrementing = true;

    protected $fillable = [
        'fechaCreacion',
        'estado',
        'fid_GrupoCursos'
    ];
    public function  semestre()
    {
        return $this->hasOne(Semestre::class, 'fid_Encuesta', 'idEncuesta');
    }
    public function grupoPregunta()
    {
        return $this->hasOne(GrupoPregunta::class, 'fid_Encuesta', 'idEncuesta');
    }
    public function respuestaEncuesta()
    {
        return $this->hasMany(RespuestaEncuesta::class, 'fid_Encuesta', 'idEncuesta');
    }
    public function grupoCursos()
    {
        return $this->belongsTo(GrupoCursos::class, 'fid_GrupoCursos', 'idGrupoCursos');
    }
}



