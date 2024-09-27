<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $table = 'criterio';
    protected $primaryKey = 'idCriterio';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'obligatorio',
        'descripcion'
    ];

    protected $casts = [
        'obligatorio' => 'boolean'
    ];

    // Relaciones
    public function gruposCriterios()
    {
        return $this->belongsToMany(GrupoCriterios::class, 'grupo_criterios_criterios', 'criterio_id', 'grupo_criterios_id');
    }
}
