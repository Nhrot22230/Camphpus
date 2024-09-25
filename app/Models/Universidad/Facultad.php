<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    protected $primaryKey = 'idFacultad';
    public $incrementing = true;

    protected $fillable = [
        'fid_departamento',
        'nombre',
        'estado',
    ];

    // Relaciones
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'fid_departamento', 'idDepartamento');
    }

    public function especialidades()
    {
        return $this->hasMany(Especialidad::class, 'fid_facultad', 'idFacultad');
    }
}
