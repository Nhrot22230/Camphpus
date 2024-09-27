<?php

namespace App\Models\Pedidos;

use App\Models\Universidad\Curso;
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
    ];

    public function cursos_propuestos()
    {
        return $this->hasMany(Curso::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }
}
