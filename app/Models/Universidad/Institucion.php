<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucion';
    protected $primaryKey = 'idInstitucion';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'logo',
        'direccion',
        'telefono',
    ];


}
