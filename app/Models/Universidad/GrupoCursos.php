<?php

namespace App\Models\Universidad;

use App\Models\Procesos\Encuesta;
use Illuminate\Database\Eloquent\Model;

class GrupoCursos extends Model
{
    protected $table = 'grupo_cursos';
    protected $primaryKey = 'idGrupoCursos';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'curso_grupoCursos');
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class, 'fid_GrupoCursos');
    }
}
