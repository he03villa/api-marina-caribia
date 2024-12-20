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
}
