<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Usuario;

class Observacion extends Model
{
    protected $table = 'observacion';
    protected $primaryKey = 'idObservacion';
    public $incrementing = true;

    protected $fillable = [
        'fid_usuario',
        'descripcion',
        'urlFile'
    ];

    // Relaciones
    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }

    public function estudianteTesis()
    {
        return $this->hasOne(EstudianteTesis::class, 'fid_observacion', 'idObservacion');
    }
}
