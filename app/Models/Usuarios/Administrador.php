<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
    protected $table = 'administrador';
    protected $primaryKey = 'idAdministrador';

    protected $fillable = [
        'fid_usuario',
        'codAdmin'
        // Otros atributos específicos de Administrador
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }
}
