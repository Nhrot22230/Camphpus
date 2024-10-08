<?php

namespace App\Models\Usuarios;

use App\Models\Documentos\EstudianteTesis;
use App\Models\Documentos\Tesis;
use App\Models\Procesos\ComiteEvaluador;
use App\Models\Universidad\Horario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';
    protected $primaryKey = 'idDocente';

    protected $fillable = [
        'codDocente',
        'fid_usuario',
        'fid_horario',
        // Otros atributos específicos de Docente
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }

    public function tesis()
    {
        return $this->belongsToMany(Tesis::class, 'docente_tesis', 'docente_id', 'tesis_id');
    }

    public function estudianteTesis()
    {
        return $this->belongsToMany(EstudianteTesis::class, 'estudiante_tesis_asesores', 'docente_id', 'estudiante_tesis_id');
    }

    public function comiteEvaluador()
    {
        return $this->belongsTo(ComiteEvaluador::class, 'fid_comite_evaluador', 'idComiteEvaluador');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'fid_horario', 'idHorario');
    }
}
