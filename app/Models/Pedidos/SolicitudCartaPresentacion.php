<?php

namespace App\Models\Pedidos;

use Illuminate\Database\Eloquent\Model;

class SolicitudCartaPresentacion extends Model
{
    protected $table = 'solicitud_carta_presentacion';
    protected $primaryKey = 'idSolicitudCartaPresentacion';
    public $incrementing = true;

    protected $fillable = [
        'fid_estudiante',
        'fid_asesor',
        'fid_directorCarrera',
        'fid_secretario',
        'cartaPresentacion',
        'actividades',
        'estado',
        'fid_curso',
    ];

    protected $casts = [
        'actividades' => 'array',
        'carta_presentacion' => 'binary',
    ];

    // Relaciones con otras tablas
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'fid_estudiante', 'idEstudiante');
    }

    public function asesor()
    {
        return $this->belongsTo(Docente::class, 'fid_asesor', 'idDocente');
    }

    public function directorCarrera()
    {
        return $this->belongsTo(Administrativo::class, 'fid_directorCarrera', 'idAdministrativo');
    }

    public function secretaria()
    {
        return $this->belongsTo(Administrativo::class, 'fid_secretario', 'idAdministrativo');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'fid_curso', 'idCurso');
    }
}
