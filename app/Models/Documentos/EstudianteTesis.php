<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Docente;
use App\Models\Usuarios\Estudiante;

class EstudianteTesis extends Model
{
    protected $table = 'estudiante_tesis';
    protected $primaryKey = 'idEstudianteTesis';
    public $incrementing = true;

    protected $fillable = [
        'fid_tesis',
        'fid_observacion'
    ];

    // Relaciones
    public function tesis()
    {
        return $this->belongsTo(Tesis::class, 'fid_tesis', 'idTesis');
    }

    public function autores()
    {
        return $this->belongsToMany(Estudiante::class, 'estudiante_tesis_autores', 'estudiante_tesis_id', 'estudiante_id');
    }

    public function asesores()
    {
        return $this->belongsToMany(Docente::class, 'estudiante_tesis_asesores', 'estudiante_tesis_id', 'docente_id');
    }

    public function observacion()
    {
        return $this->belongsTo(Observacion::class, 'fid_observacion', 'idObservacion');
    }
}
