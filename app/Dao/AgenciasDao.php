<?php

namespace App\Dao;
use App\Models\Agencias;
use App\Models\Cliente;

class AgenciasDao
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Agencias[]
     */
    public function getAgencias()
    {
        return Agencias::all();
    }

    /**
     * Retrieve all active Agencias.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Agencias[]
     */
    public function getAgenciasActivas()
    {
        return Agencias::where('estado', 'Activo')->get();
    }

    /**
     * Deletes a specific Agencia by its ID.
     *
     * @param int $id
     * @return Agencias
     */
    public function deleteAgencia($id)
    {
        $agencia = Agencias::find($id);
        $agencia->delete();
        return $agencia;
    }

    /**
     * Updates a specific Agencia by its ID.
     *
     * @param int $id
     * @param array $data
     * @return Agencias
     */
    public function updateAgencia($id, $data)
    {
        $agencia = Agencias::find($id);
        $agencia->update($data);
        return $agencia;
    }

    /**
     * Retrieve a specific Agencia by its ID.
     *
     * @param int $id
     * @return Agencias|null
     */
    public function getAgencia($id)
    {
        return Agencias::with('concepto_servicios')->find($id);
    }

    /**
     * Creates a new Agencia.
     *
     * @param array $data
     * @return Agencias
     */
    public function createAgencia($data)
    {
        return Agencias::create($data);
    }

    public function saveTarifas($data)
    {
        $agencia = $this->getAgencia($data['agencia_id']);

        $agencia->concepto_servicios()->syncWithoutDetaching([
            $data['concepto_servicio_id'] => [
                'tarifa' => $data['tarifa'],
            ],
        ]);

        return $this->getAgencia($data['agencia_id']);
    }

    public function getAgenciaByFiltro($filtro)
    {
        $buscar = "";
        if ($filtro) {
            $buscar = $filtro['buscar'] ?? "";
        }
        $agencia = Agencias::query();
        if ($buscar != "") {
            $agencia = $agencia->where('id', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('id_agencia', 'like', '%' . $buscar . '%')
                ->orWhere('estado', 'like', '%' . $buscar . '%');
        }
        $agencia = $agencia->with('concepto_servicios')->orderBy('id', 'desc')->get();
        return $agencia;
    }

    public function getPasarTarifas($cliente, $agencia) {
        $clientes = Cliente::with('concepto_servicios')->where('id', $cliente)->first();
        $agencia = Agencias::where('id', $agencia)->first();
        $data = [];
        $consepto_servicios = $clientes->concepto_servicios;
        foreach ($consepto_servicios as $consepto_servicio) {
            $data[] = [
                'concepto_servicio_id' => $consepto_servicio->id,
                'tarifa' => $consepto_servicio->pivot->tarifa,
                'agencia_id' => $agencia->id,
            ];
        }
        foreach ($data as $item) {
            $this->saveTarifas($item);
        }
        return $data;
    }
}