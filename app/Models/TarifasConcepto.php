<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifasConcepto extends Model
{
    use HasFactory;

    protected $fillable = [
        'concepto_servicio_id',
        'puerto_or_destino_id',
        'tipo_cliente',
        'tarifa',
    ];

    const REGULAR = 'REGULAR';
    const PLENA = 'PLENA';
    const OCEANICA = 'OCEANICA';
    const SEABOARD = 'SEABOARD DE COLOMBIA S.A.';
    const GRUPO = 'GRUPO AGENCIA & LOGISTICA SAS';
    const SOCIEDAD = 'SOCIEDAD PORTUARIA REGIONAL DE SANTA MARTA SA';
    const CARSEA = 'CARSEA';
    const RM = 'RMREGULAR';
    const RMP = 'RMPLENA';
    const CMA = 'CMA';

}
