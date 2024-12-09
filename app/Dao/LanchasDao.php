<?php

namespace App\Dao;
use App\Models\Lanchas;

class LanchasDao
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Lanchas[]
     */
    public function getLanchas()
    {
        return Lanchas::all();
    }

    /**
     * Retrieves all active Lanchas.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Lanchas[]
     */
    public function getLanchasActivas()
    {
        return Lanchas::where('estado', 'Activo')->get();
    }

    /**
     * Creates a new Lancha.
     *
     * @param array $data
     * @return Lanchas
     */
    public function createLancha($data)
    {
        return Lanchas::create($data);
    }

    public function getLancha($id)
    {
        return Lanchas::find($id);
    }

    public function updateLancha($id, $data)
    {
        $lancha = Lanchas::find($id);
        $lancha->update($data);
        return $lancha;
    }

    public function deleteLancha($id)
    {
        $lancha = Lanchas::find($id);
        $lancha->delete();
        return $lancha;
    }
}