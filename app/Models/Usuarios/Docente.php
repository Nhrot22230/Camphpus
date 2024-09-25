<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';
    protected $primaryKey = 'codDocente';

    protected $fillable = [
        'fid_usuario',
        // Otros atributos específicos de Docente
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }
}