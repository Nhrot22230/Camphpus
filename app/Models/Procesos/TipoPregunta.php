<?php

namespace App\Models\Procesos;

enum TipoPregunta
{
    case Alternativas;
    case RespuestaLibre;
    case VerdaderoOFalso;
}
