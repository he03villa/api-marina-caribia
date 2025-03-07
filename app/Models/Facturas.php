<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory;

    const PENDIENTE = 'pendiente';
    const PAGADA = 'pagada';
    const CANCELADA = 'cancelada';

    protected $fillable = [
        'boleta_servicio_id',
        'numero_factura',
        'total',
        'estado',
    ];

    function detalle() {
        return $this->hasMany(FacturasDetalles::class)->with('concepto');
    }

    function boleta() {
        return $this->belongsTo(BoletaServicio::class, 'boleta_servicio_id')->with('servicios', 'agencias', 'destinos', 'embarcaciones', 'motonaves');
    }
}
