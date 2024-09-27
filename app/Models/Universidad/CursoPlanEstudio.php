<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class CursoPlanEstudio extends Model
{
    protected $table = 'curso_plan_estudio';
    protected $primaryKey = 'idCursoPlanEstudio';
    public $incrementing = true;

    protected $fillable = [
        'nivel',
        'fid_requisitos',
        'fid_curso',
        'fid_planEstudio',
        'fid_curso',
        'fid_pedidoCurso'
    ];
}
