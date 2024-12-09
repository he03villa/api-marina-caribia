<?php

namespace App\Dao;
use App\Models\MotoNaves;

class MotoNavesDao
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|MotoNaves[]
     */
    public function getMotoNaves()
    {
        return MotoNaves::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|MotoNaves[]
     */
    public function getMotoNavesActivas()
    {
        return MotoNaves::where('estado', 'Activo')->get();
    }

    /**
     * Obtiene una motonave por su id
     *
     * @param int $id
     * @return MotoNaves|null
     */
    public function getMotoNave($id)
    {
        return MotoNaves::find($id);
    }

    /**
     * Crea una nueva motonave.
     *
     * @param array $data Datos de la motonave a crear.
     * @return MotoNaves La motonave creada.
     */
    public function createMotoNave($data)
    {
        return MotoNaves::create($data);
    }

    /**
     * Updates a specific MotoNave by its ID.
     *
     * @param int $id The ID of the MotoNave to update.
     * @param array $data The data to update the MotoNave with.
     * @return MotoNaves The updated MotoNave.
     */
    public function updateMotoNave($id, $data)
    {
        $motoNave = MotoNaves::find($id);
        $motoNave->update($data);
        return $motoNave;
    }

    /**
     * Deletes a specific MotoNave by its ID.
     *
     * @param int $id The ID of the MotoNave to delete.
     * @return MotoNaves The deleted MotoNave.
     */
    public function deleteMotoNave($id)
    {
        $motoNave = MotoNaves::find($id);
        $motoNave->delete();
        return $motoNave;
    }
}