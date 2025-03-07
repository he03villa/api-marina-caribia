<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturasDetalles extends Model
{
    use HasFactory;

    protected $fillable = [
        'facturas_id',
        'tarifas_concepto_id',
        'cantidad',
        'subtotal',
    ];

    function factura(){
        return $this->belongsTo(Facturas::class, 'id', 'facturas_id');
    }

    function concepto(){
        return $this->belongsTo(Concepto_servicios::class, 'tarifas_concepto_id', 'id');
    }
}
