<?php

namespace App\Models\Procesos;

enum EtapaProceso
{
    case EnvioCV;
    case RecepcionCV;
    case RevisionPerfil;
    case EntrevistaPersonal;
    case EvaluacionFinal;
    case ResultadosEntregados;
}
