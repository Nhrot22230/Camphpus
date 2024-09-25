<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'idCurso';
    public $incrementing = true;
    
    protected $fillable = [
        'fid_especialidad', 
        'cod_curso',
        'nombre',
        'creditos',
        'estado',
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
