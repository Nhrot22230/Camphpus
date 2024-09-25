<?php

namespace App\Models\Usuarios;

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
}