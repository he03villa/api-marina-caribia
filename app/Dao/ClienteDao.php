<?php

namespace App\Dao;
use App\Models\Cliente;

class ClienteDao
{
    public function getClientes()
    {
        return Cliente::all();
    }

    public function getCliente($id)
    {
        return Cliente::with('concepto_servicios')->find($id);
    }

    public function createCliente($data)
    {
        return Cliente::create($data);
    }

    public function updateCliente($id, $data)
    {
        $cliente = Cliente::find($id);
        $cliente->update($data);
        return $cliente;
    }

    public function deleteCliente($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return $cliente;
    }

    public function getClienteByFiltro($filtro)
    {
        $buscar = "";
        if ($filtro) {
            $buscar = $filtro['buscar'] ?? "";
        }
        $clientes = Cliente::query();
        if ($buscar != "") {
            $clientes = $clientes->where('id', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('id_cliente', 'like', '%' . $buscar . '%')
                ->orWhere('id_tarifa', 'like', '%' . $buscar . '%')
                ->orWhere('tarifa', 'like', '%' . $buscar . '%')
                ->orWhere('estado', 'like', '%' . $buscar . '%');
        }
        $clientes = $clientes->with('concepto_servicios')->orderBy('id', 'desc')->get();
        return $clientes;
    }

    public function saveTarifas($data)
    {
        $cliente = $this->getCliente($data['cliente_id']);

        $cliente->concepto_servicios()->syncWithoutDetaching([
            $data['concepto_servicio_id'] => [
                'tarifa' => $data['tarifa'],
            ],
        ]);

        return $this->getCliente($data['cliente_id']);
    }

}