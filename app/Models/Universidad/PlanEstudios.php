<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class PlanEstudios extends Model
{
    protected $table = 'plan_estudios';
    protected $primaryKey = 'idPlanEstudios';
    public $incrementing = true;
    protected $fillable = [
        'fid_cursosPropuestos',
        'aprobado',
        'observaciones',
        'fid_semestre',
        'fid_facultad',
        'fid_especialiad'
    ];
}
