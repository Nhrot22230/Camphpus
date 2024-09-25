<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'permiso';
    protected $primaryKey = 'idPermiso';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'slug',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'permiso_rol', 'permiso_id', 'rol_id');
    }
}

