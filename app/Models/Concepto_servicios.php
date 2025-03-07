<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto_servicios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'servicio_id',
    ];

    function tarifa() {
        return $this->hasMany(TarifasConcepto::class);
    }
}
