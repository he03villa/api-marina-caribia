<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_agencia',
        'estado',
    ];

    public function concepto_servicios(){
        return $this->belongsToMany(Concepto_servicios::class, 'tarifas_conceptos_agencia', 'agencia_id', 'concepto_servicio_id')
                    ->withPivot('tarifa', 'id');
    }
}
