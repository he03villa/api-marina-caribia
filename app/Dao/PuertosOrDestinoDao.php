<?php

namespace App\Dao;
use App\Models\PuertoOrDestino;

class PuertoOrDestinoDao {

    public function __construct() {
        // Constructor logic (opcional)
    }
    
    /**
     * Retrieves all PuertoOrDestino objects from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|PuertoOrDestino[]
     */
    public function getAll() {
        return PuertoOrDestino::all();
    }

    /**
     * Retrieves a specific PuertoOrDestino by its ID.
     *
     * @param int $id
     * @return PuertoOrDestino|null
     */
    public function getPuertoOrDestino($id) {
        return PuertoOrDestino::find($id);
    }

    /**
     * Creates a new PuertoOrDestino.
     *
     * @param array $data The data to create the PuertoOrDestino with.
     * @return PuertoOrDestino The created PuertoOrDestino.
     */
    public function createPuertoOrDestino($data) {
        return PuertoOrDestino::create($data);
    }

    /**
     * Updates a specific PuertoOrDestino by its ID.
     *
     * @param int $id The ID of the PuertoOrDestino to update.
     * @param array $data The data to update the PuertoOrDestino with.
     * @return PuertoOrDestino The updated PuertoOrDestino.
     */
    public function updatePuertoOrDestino($id, $data) {
        $puertoOrDestino = PuertoOrDestino::find($id);
        $puertoOrDestino->update($data);
        return $puertoOrDestino;
    }

    /**
     * Deletes a specific PuertoOrDestino by its ID.
     *
     * @param int $id The ID of the PuertoOrDestino to delete.
     * @return PuertoOrDestino The deleted PuertoOrDestino.
     */
    public function deletePuertoOrDestino($id) {
        $puertoOrDestino = PuertoOrDestino::find($id);
        $puertoOrDestino->delete();
        return $puertoOrDestino;
    }

    /**
     * Retrieves all active PuertoOrDestino objects from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|PuertoOrDestino[]
     */
    public function getPuertoOrDestinoActivas()
    {
        return PuertoOrDestino::where('estado', 'Activo')->get();
    }
}