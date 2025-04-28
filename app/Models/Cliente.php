<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'id_cliente',
        'id_tarifa',
        'tarifa',
        'estado',
    ];

    public function concepto_servicios(){
        return $this->belongsToMany(Concepto_servicios::class, 'tarifas_conceptos_cliente', 'cliente_id', 'concepto_servicio_id')
                    ->withPivot('tarifa', 'id');
    }
}
