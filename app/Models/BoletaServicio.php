<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoletaServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_boleta_servicio',
        'destino',
        'agencia',
        'embarcacion',
        'piloto',
        'servicio',
        'fecha_inicio',
        'hora_inicio',
        'fecha_final',
        'hora_final',
        'observaciones',
        'moto_nave',
        'estado',
        'facturacion',
    ];

    public function destinos(){
        return $this->belongsTo(PuertoOrDestino::class, 'destino')->with('servicios', 'concepto_servicios');
    }

    public function agencias(){
        return $this->belongsTo(Agencias::class, 'agencia');
    }
    
    public function embarcaciones(){
        return $this->belongsTo(Lanchas::class, 'embarcacion');
    }

    public function pilotos(){
        return $this->belongsTo(Pilotos::class, 'piloto');
    }

    public function servicios(){
        return $this->belongsTo(Servicios::class, 'servicio');
    }

    public function motonaves(){
        return $this->belongsTo(MotoNaves::class, 'moto_nave');
    }

    public function trabajadores(){
        return $this->belongsToMany(Trabajador::class);
    }

    public function diasOrdenados()
    {
        $fechaInicio = date_create(date('Y-m-d'));
        $fechaFin = date_create($this->order_date);
        $dias = date_diff($fechaInicio, $fechaFin);
        return $dias->days;
    }

    public function facturas(){
        return $this->belongsTo(Facturas::class, 'id', 'boleta_servicio_id')->with('detalle');
    }
}
