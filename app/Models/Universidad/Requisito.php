<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table = 'requisito';
    protected $primaryKey = 'idRequisito';
    public $incrementing = true;

    protected $fillable = [
        'tipoRequisito',
        'codigo_creditos',
        'fid_cursoPlanEstudio'
    ];

    public function cursoPlanEstudio()
    {
        return $this->belongsTo(CursoPlanEstudio::class, 'fid_cursoPlanEstudio', 'idCursoPlanEstudio');
    }
}
