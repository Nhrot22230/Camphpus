<?php

namespace App\Models\Universidad;

use App\Models\Procesos\ComiteEvaluador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Docente;

class Seccion extends Model
{
    protected $table = 'seccion';
    protected $primaryKey = 'idSeccion';
    public $timestamps = false;

    protected $fillable = [
        'fid_departamento',
        'cod_jefeSeccion',
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relaciones
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'fid_departamento', 'idDepartamento');
    }

    public function jefeSeccion()
    {
        return $this->belongsTo(Docente::class, 'cod_jefeSeccion', 'codDocente');
    }

    /*public function comites_evaluadores()
    {
        return $this->hasMany(ComiteEvaluador::class, 'fid_seccion', 'idSeccion');
    }*/
}
