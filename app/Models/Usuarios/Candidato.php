<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Procesos\CandidatoConvocatoria;

class Candidato extends Model
{
    use HasFactory;
    protected $table = 'candidato';
    protected $primaryKey = 'codCandidato';

    protected $fillable = [
        'fid_usuario',
        // Otros atributos específicos de CandidatoDocente
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'fid_usuario', 'idUsuario');
    }

    public function candidatoConvocatorias()
    {
        return $this->hasMany(CandidatoConvocatoria::class, 'fid_candidato', 'idCandidato');
    }
}
