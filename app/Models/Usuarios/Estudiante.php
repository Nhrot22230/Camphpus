<?php

namespace App\Models\Usuarios;

use App\Models\Documentos\EstudianteTesis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiante';
    protected $primaryKey = 'codEstudiante';

    protected $fillable = [
        'fid_usuario',
        // Otros atributos específicos de Estudiante
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }

    public function estudianteTesis()
    {
        return $this->belongsToMany(EstudianteTesis::class, 'estudiante_tesis_autores', 'estudiante_id', 'estudiante_tesis_id');
    }
}