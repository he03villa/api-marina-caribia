<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuertoOrDestino extends Model
{
    use HasFactory;


    public function servicios(){
        return $this->belongsToMany(Servicios::class, 'servicio_puerto', 'puerto_or_destino_id', 'servicio_id');
    }

    public function concepto_servicios(){
        return $this->belongsToMany(Concepto_servicios::class, 'tarifas_conceptos', 'puerto_or_destino_id', 'concepto_servicio_id')
                    ->withPivot('tarifa', 'id');
    }
}
