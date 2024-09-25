<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    public $incrementing = true;

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'correo',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_usuario', 'usuario_id', 'rol_id');
    }

    // Relaciones con subclases
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'fid_usuario', 'idUsuario');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'fid_usuario', 'idUsuario');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'fid_usuario', 'idUsuario');
    }

    public function candidato()
    {
        return $this->hasOne(Candidato::class, 'fid_usuario', 'idUsuario');
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     */
    public function tieneRol($nombreRol)
    {
        return $this->roles->contains('nombre', $nombreRol);
    }

    /**
     * Verifica si el usuario tiene un permiso específico.
     */
    public function tienePermiso($slugPermiso)
    {
        foreach ($this->roles as $rol) {
            if ($rol->permisosAsignados->contains('slug', $slugPermiso)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Obtiene el nombre completo del usuario.
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
