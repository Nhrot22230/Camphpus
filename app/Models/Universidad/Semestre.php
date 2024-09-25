<?php

namespace App\Models\Universidad;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = 'semestre';
    protected $primaryKey = 'idSemestre';
    public $incrementing = true;

    protected $fillable = [
        'anho',
        'periodo',
        'estado',
    ];
}
