<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Candidato;

class Convocatoria extends Model
{
    protected $table = 'convocatoria';
    protected $primaryKey = 'idConvocatoria';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'fechaInicio',
        'fechaFin',
        'descripcion',
        'seleccionado',
        'estado',
        'fid_comite_evaluador',
        'fid_grupo_criterios'
    ];

    protected $casts = [
        'fechaInicio' => 'timestamp',
        'fechaFin' => 'timestamp',
        'seleccionado' => Candidato::class,
        'estado' => 'boolean'
    ];

    // Relaciones
    public function comiteEvaluador()
    {
        return $this->belongsTo(ComiteEvaluador::class, 'fid_comite_evaluador', 'idComiteEvaluador');
    }

    public function grupoCriterios()
    {
        return $this->belongsTo(GrupoCriterios::class, 'fid_grupo_criterios', 'idGrupoCriterios');
    }
}
