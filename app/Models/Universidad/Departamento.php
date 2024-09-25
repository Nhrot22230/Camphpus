<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'idDepartamento';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function secciones()
    {
        return $this->hasMany(Seccion::class, 'fid_departamento', 'idDepartamento');
    }

    public function facultades()
    {
        return $this->hasMany(Facultad::class, 'fid_departamento', 'idDepartamento');
    }
}
