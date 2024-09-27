<?php

namespace App\Models\Usuarios;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles, HasApiTokens;

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
        'password',
        'external_id',  // Agregado
        'external_auth',  // Agregado
        'avatar',  // Agregado
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

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
    
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Devuelve el identificador que se almacenará en el subject claim del JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Esto retornará el id del usuario (idUsuario)
    }

    /**
     * Devuelve un array con los claims personalizados del JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
