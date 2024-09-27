<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Candidato;

class CandidatoConvocatoria extends Model
{
    protected $table = 'candidato_convocatoria';
    protected $primaryKey = 'idCandidatoConvocatoria';
    public $incrementing = true;

    protected $fillable = [
        'etapaProceso',
        'activo',
        'urlCV',
        'fechaInicio',
        'fid_convocatoria',
        'fid_candidato'
    ];

    protected $casts = [
        'etapaProceso' => EtapaProceso::class,
        'activo' => 'boolean',
        'fechaInicio' => 'timestamp'
    ];

    // Relaciones
    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'fid_convocatoria', 'idConvocatoria');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'fid_candidato', 'idCandidato');
    }
}
