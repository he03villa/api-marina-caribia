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
        'descuento',
    ];

    protected $appends = ['total_label'];

    function detalle() {
        return $this->hasMany(FacturasDetalles::class)->with('concepto');
    }

    function boleta() {
        return $this->belongsTo(BoletaServicio::class, 'boleta_servicio_id')->with('servicios', 'agencias', 'destinos', 'embarcaciones', 'motonaves');
    }

    function boletas() {
        return $this->belongsToMany(BoletaServicio::class, 'factura_boleta_servicio', 'factura_id', 'boleta_servicio_id')->with('servicios', 'agencias', 'destinos', 'embarcaciones', 'motonaves');
    }

    function getTotalLabelAttribute() {
        return $this->total - ($this->total * ($this->descuento / 100));
    }
}
