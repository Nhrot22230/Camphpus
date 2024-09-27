<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Universidad\Seccion;
use App\Models\Usuarios\Docente;

class ComiteEvaluador extends Model
{
    protected $table = 'comite_evaluador';
    protected $primaryKey = 'idComiteEvaluador';
    public $incrementing = true;

    protected $fillable = [
        'fid_seccion'
    ];

    // Relaciones
    public function miembros()
    {
        return $this->hasMany(Docente::class, 'fid_comite_evaluador', 'idComiteEvaluador');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'fid_seccion', 'idSeccion');
    }

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'fid_comite_evaluador', 'idComiteEvaluador');
    }
}
