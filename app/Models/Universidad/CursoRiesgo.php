<?php

namespace App\Models\Universidad;

use App\Models\Documentos\InformeRespuesta;
use App\Models\Procesos\MotivoRiesgo;
use Illuminate\Database\Eloquent\Model;

class CursoRiesgo extends Model
{
    protected $table = 'cursoRiesgo';
    protected $primaryKey = 'idCursoRiesgo';
    public $incrementing = true;

    protected $fillable = [
        'aproboCurso',
        'fid_Horario',
        'fid_Curso',
    ];
    protected $casts = [
        'motivoRiesgo'=>MotivoRiesgo::class,
    ];
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_Curso', 'id_Curso');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'fid_Horario', 'id_Horario');
    }
    public function informes()
    {
        return $this->HasMany(InformeRespuesta::class,'fid_CursoRiesgo','idCursoRiesgo');
    }
}
