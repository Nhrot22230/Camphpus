<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;

class GrupoCriterios extends Model
{
    protected $table = 'grupo_criterios';
    protected $primaryKey = 'idGrupoCriterios';
    public $incrementing = true;

    protected $fillable = [
        'nombre'
    ];

    // Relaciones
    public function criterios()
    {
        return $this->belongsToMany(Criterio::class, 'grupo_criterios_criterios', 'grupo_criterios_id', 'criterio_id');
    }

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'fid_grupo_criterios', 'idGrupoCriterios');
    }
}
