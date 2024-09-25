<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'idArea';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'fid_especialidad',
        'estado',
    ];

    // Relaciones
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'fid_especialidad', 'idEspecialidad');
    }
}
