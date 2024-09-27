<?php

namespace App\Models\Usuarios;

use App\Models\Documentos\Observacion;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'correo',
        'estado',
        'password', // Asegúrate de incluir este campo
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

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'fid_usuario', 'idUsuario');
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
