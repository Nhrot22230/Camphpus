<?php

namespace App\Models\Universidad;

use App\Models\Pedidos\PedidoCursos;
use Illuminate\Database\Eloquent\Model;

class CursoPlanEstudio extends Model
{
    protected $table = 'curso_plan_estudio';
    protected $primaryKey = 'idCursoPlanEstudio';
    public $incrementing = true;

    protected $fillable = [
        'nivel',
        'fid_curso',
        'fid_planEstudio',
        'fid_pedidoCurso'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_curso', 'idCurso');
    }

    public function requisitos()
    {
        return $this->hasMany(Requisito::class, 'fid_cursoPlanEstudio');
    }

    public function plan_estudio()
    {
        return $this->belongsTo(PlanEstudios::class, 'fid_planEstudio', 'idPlanEstudio');
    }

    public function pedido_curso()
    {
        return $this->hasMany(PedidoCursos::class, 'pedidoCurso_cursosPlanEstudios');
    }
}
