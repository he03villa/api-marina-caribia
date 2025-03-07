<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_servicio',
        'estado',
    ];

    public function sub_servicios(){
        return $this->hasMany(Servicios::class, 'id_servicio');
    }

    public function concepto_servicios(){
        return $this->hasMany(Concepto_servicios::class, 'servicio_id');
    }
}
