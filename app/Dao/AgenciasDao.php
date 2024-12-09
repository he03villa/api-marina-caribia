<?php

namespace App\Dao;
use App\Models\Agencias;

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
        return Agencias::find($id);
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
}