<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;
use App\Models\Documentos\Tesis;

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

    public function tesis()
    {
        return $this->hasMany(Tesis::class, 'fid_especialidad', 'idEspecialidad');
    }
}
