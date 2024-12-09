<?php

namespace App\Dao;
use App\Models\Pilotos;

class PilotosDao
{
    /**
     * Retrieves a specific Piloto by its ID.
     * 
     * @param int $id
     * @return Pilotos|null
     */
    public function getPiloto($id)
    {
        return Pilotos::find($id);
    }

    /**
     * Creates a new Piloto.
     * 
     * @param array $data
     * @return Pilotos The created Piloto.
     */
    public function createPiloto($data)
    {
        return Pilotos::create($data);
    }

    /**
     * Updates a specific Piloto by its ID.
     *
     * @param int $id The ID of the Piloto to update.
     * @param array $data The data to update the Piloto with.
     * @return Pilotos The updated Piloto.
     */
    public function updatePiloto($id, $data)
    {
        $piloto = Pilotos::find($id);
        $piloto->update($data);
        return $piloto;
    }

    /**
     * Deletes a specific Piloto by its ID.
     * 
     * @param int $id The ID of the Piloto to delete.
     * @return Pilotos The deleted Piloto.
     */
    public function deletePiloto($id)
    {
        $piloto = Pilotos::find($id);
        $piloto->delete();
        return $piloto;
    }

    /**
     * Retrieves all active Pilotos.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|Pilotos[]
     */
    public function getPilotosActivas()
    {
        return Pilotos::where('estado', 'Activo')->get();
    }
}