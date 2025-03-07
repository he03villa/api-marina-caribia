<?php

namespace App\Dao;

use App\Models\Concepto_servicios;
use App\Models\TarifasConcepto;

class TarifasConceptoDao
{
    public function getAll() {
        return TarifasConcepto::all();
    }

    public function get($id) {
        return TarifasConcepto::find($id);
    }

    public function create($data) {
        return TarifasConcepto::create($data);
    }

    public function update($id, $data) {
        $tarifa = TarifasConcepto::find($id);
        $tarifa->update($data);
        return $tarifa;
    }

    public function delete($id) {    
        $tarifa = TarifasConcepto::find($id);
        $tarifa->delete();
        return $tarifa;
    }

    public function deleteAll() {
        TarifasConcepto::truncate();
    }

    public function findCodigo($name) {
        return Concepto_servicios::where('codigo', $name)->first();
    }

    public function macibo($data) {
        $dataTarifa = array_map(function ($item) use($data) {
            $consepto = $this->findCodigo($item['codigo']);
            return [
                'concepto_servicio_id' => $consepto->id,
                'tarifa' => $item['valor'],
                'puerto_or_destino_id' => $data['puerto'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $data['tarifas']);

        return TarifasConcepto::insert($dataTarifa);
    }
}