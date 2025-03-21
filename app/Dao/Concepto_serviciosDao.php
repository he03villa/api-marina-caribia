<?php

namespace App\Dao;

use App\Models\Concepto_servicios;
use App\Models\TarifasConcepto;

class Concepto_serviciosDao
{
    public function getAll() {
        return Concepto_servicios::all();
    }

    public function findByConceptoAndPuerto($concepto, $puerto) {
        return TarifasConcepto::where('concepto_servicio_id', $concepto)->where('puerto_or_destino_id', $puerto)->first();
    }

    public function find($concepto) {
        return Concepto_servicios::find($concepto)->with('tarifa');
    }

    public function save($data) {
        $concepto = $this->findByConceptoAndPuerto($data['concepto_servicio_id'], $data['puerto_or_destino_id']);
        if ($concepto) {
            $concepto->update($data);
        } else {
            $concepto = TarifasConcepto::create($data);
        }
        $_puetoDao = new PuertosOrDestinoDao();
        $puerto = $_puetoDao->getPuertoOrDestino($data['puerto_or_destino_id']);
        return $puerto;
    }
}