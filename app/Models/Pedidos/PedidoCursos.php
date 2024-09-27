<?php

namespace App\Models\Pedidos;

use App\Models\Universidad\Curso;
use App\Models\Universidad\CursoPlanEstudio;
use App\Models\Universidad\Especialidad;
use App\Models\Universidad\Facultad;
use App\Models\Universidad\Semestre;
use Illuminate\Database\Eloquent\Model;
class PedidoCursos extends Model
{
    protected $table = 'pedido_cursos';
    protected $primaryKey = 'idPedidoCursos';
    public $incrementing = true;

    protected $fillable = [
        'aprobado',
        'observaciones',
        'fid_semestre',
        'fid_facultad',
        'fid_especialiad'
    ];

    public function cursos_propuestos()
    {
        return $this->hasMany(CursoPlanEstudio::class, 'pedidoCurso_cursosPlanEstudios');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'fid_especialiad', 'idEspecialidad');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'fid_semestre', 'idSemestre');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'fid_facultad', 'idFacultad');
    }
}
