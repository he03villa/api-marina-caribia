<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'id_cargo',
        'sexo',
        'estado'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    public function boletas()
    {
        return $this->belongsToMany(BoletaServicio::class);
    }
}
