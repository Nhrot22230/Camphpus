<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;

class GrupoPregunta extends Model
{
    protected $table = 'grupoPregunta';
    protected $primaryKey = 'idGrupoPregunta';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'fechaCreacion',
        'numeroPreguntas',
        'fid_Encuesta',
    ];

    public function pregunta()
    {
        return $this->hasMany(Pregunta::class,'fid_GrupoPregunta','idGrupoPregunta');
    }
    public function encuesta()
    {
        return $this->belongsToMany(Encuesta::class,'fid_Encuesta','idEncuesta');
    }
}
