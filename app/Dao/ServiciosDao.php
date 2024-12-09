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
        return Servicios::find($id);
    }

    /**
     * Creates a new Servicios record in the database.
     *
     * @param array $data The data to create the Servicios record with.
     * @return Servicios The created Servicios object.
     */
    public function create($data) {
        return Servicios::create($data);
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
}