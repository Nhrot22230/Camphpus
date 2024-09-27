<?php

namespace App\Models\Documentos;

use App\Models\Universidad\Semestre;
use Illuminate\Database\Eloquent\Model;

class InformeRiesgo extends Model
{
    protected $table = 'informe_riesgo';
    protected $primaryKey = 'idInformeRiesgo';
    public $incrementing = true;

    protected $fillable = [
        'semana',
        'fechainicio',
        'estado',
        'fid_semestre',
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'fid_semestre', 'idSemestre');
    }
}
