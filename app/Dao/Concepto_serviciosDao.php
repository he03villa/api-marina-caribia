<?php

namespace App\Dao;

use App\Models\Concepto_servicios;

class Concepto_serviciosDao
{
    public function getAll() {
        return Concepto_servicios::all();
    }
}