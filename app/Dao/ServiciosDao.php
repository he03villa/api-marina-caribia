<?php

namespace App\Dao;
use App\Models\Servicios;

class ServiciosDao {
    /**
     * Retrieves all Servicios objects from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Servicios[]
     */
    public function getAll() {
        return Servicios::all();
    }

    /**
     * Retrieve a specific Servicios by its ID.
     *
     * @param int $id The ID of the Servicios to retrieve.
     * @return Servicios|null The Servicios object if found, otherwise null.
     */
    public function getById($id) {
        $servicios = Servicios::with('concepto_servicios')->find($id);
        $servicios['codigo'] = $servicios->id_servicio;
        return $servicios;
    }

    /**
     * Creates a new Servicios record in the database.
     *
     * @param array $data The data to create the Servicios record with.
     * @return Servicios The created Servicios object.
     */
    public function create($data) {
        return Servicios::create($data)->concepto_servicios()->createMany($data['concepto_servicios']);
    }

    /**
     * Updates a specific Servicios record by its ID.
     *
     * @param int $id The ID of the Servicios to update.
     * @param array $data The data to update the Servicios record with.
     * @return Servicios The updated Servicios object.
     */
    public function update($id, $data) {
        $servicio = Servicios::find($id);
        $servicio->update($data);
        foreach ($data['concepto_servicios'] as $concepto_servicio) {
            if (isset($concepto_servicio['id'])) {
                $servicio->concepto_servicios()->find($concepto_servicio['id'])->update($concepto_servicio);
            } else {
                $servicio->concepto_servicios()->create($concepto_servicio);
            }
        }
        return $servicio;
    }

    /**
     * Deletes a specific Servicios record by its ID.
     *
     * @param int $id The ID of the Servicios to delete.
     * @return Servicios The deleted Servicios object.
     */
    public function delete($id) {    
        $servicio = Servicios::find($id);
        $servicio->delete();
        return $servicio;
    }

    /**
     * Retrieves all active Servicios objects from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Servicios[]
     */
    public function getServiciosActivos() {
        return Servicios::where('estado', 'Activo')->get();
    }

    public function getServiciosFilter($filter) {
        $buscar = "";
        if ($filter) {
            $buscar = $filter['buscar'] ?? "";
        }
        $servicio = Servicios::query();
        if ($buscar) {
            $servicio = $servicio->where('nombre', 'like', '%' . $buscar . '%')
                                ->orWhere('id_servicio', 'like', '%' . $buscar . '%');
        }
        $servicio = $servicio->where('estado', 'Activo')->orderBy('id', 'desc')->with('concepto_servicios')->get();
        return $servicio;
    }
}