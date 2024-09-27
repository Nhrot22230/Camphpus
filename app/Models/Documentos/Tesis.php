<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Universidad\Especialidad;
use App\Models\Universidad\Semestre;
use App\Models\Usuarios\Docente;

class Tesis extends Model
{
    protected $table = 'tesis';
    protected $primaryKey = 'idTesis';
    public $incrementing = true;

    protected $fillable = [
        'tema',
        'semestre',
        'fid_especialidad'
    ];

    protected $casts = [
        'semestre' => Semestre::class
    ];

    // Relaciones
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'fid_especialidad', 'idEspecialidad');
    }

    public function jurados()
    {
        return $this->belongsToMany(Docente::class, 'docente_tesis', 'tesis_id', 'docente_id');
    }

    public function estudianteTesis()
    {
        return $this->hasOne(EstudianteTesis::class, 'fid_tesis', 'idTesis');
    }
}
