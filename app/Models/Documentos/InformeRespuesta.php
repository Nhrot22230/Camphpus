<?php

namespace App\Models\Documentos;

use App\Models\Universidad\CursoRiesgo;
use App\Models\Usuarios\Docente;
use Illuminate\Database\Eloquent\Model;

class InformeRespuesta extends Model
{
    protected $table = 'informeRespuesta';
    protected $primaryKey = 'idInformeRespuesta';
    public $incrementing = true;

    protected $fillable = [
        'observaciones',
        'fechaResolucion',
        'fid_Docente',
        'fid_CursoRiesgo',
    ];
    protected $casts = [
        'desempeno'=>Desempeno::class,
        'estado'=>EstadoInforme::class,
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'fid_Docente','idDocente');
    }
    public function cursoRiesgo()
    {
        return $this->belongsTo(CursoRiesgo::class, 'fid_CursoRiesgo','idCursoRiesgo');
    }
}
