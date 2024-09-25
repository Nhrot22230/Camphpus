<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rol';
    protected $primaryKey = 'idRol';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];

    public function permisosAsignados()
    {
        return $this->belongsToMany(Permiso::class, 'permiso_rol', 'rol_id', 'permiso_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'rol_usuario', 'rol_id', 'usuario_id');
    }

    /**
     * Asigna un permiso al rol.
     */
    public function asignarPermiso(Permiso $permiso)
    {
        $this->permisosAsignados()->attach($permiso);
    }

    /**
     * Revoca un permiso del rol.
     */
    public function revocarPermiso(Permiso $permiso)
    {
        $this->permisosAsignados()->detach($permiso);
    }
}