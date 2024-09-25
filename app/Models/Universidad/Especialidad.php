<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    protected $primaryKey = 'idEspecialidad';
    public $incrementing = true;

    protected $fillable = [
        'fid_facultad',
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relaciones
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'fid_facultad', 'idFacultad');
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'fid_especialidad', 'idEspecialidad');
    }
}
