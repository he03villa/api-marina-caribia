<?php

namespace App\Dao;
use App\Models\Cargo;

class CargoDao
{
    public function getCargos()
    {
        return Cargo::all();
    }

    public function getCargo($id)
    {
        return Cargo::find($id);
    }

    public function createCargo($data)
    {
        return Cargo::create($data);
    }

    public function updateCargo($id, $data)
    {
        $cargo = Cargo::find($id);
        $cargo->update($data);
        return $cargo;
    }

    public function deleteCargo($id)
    {
        $cargo = Cargo::find($id);
        $cargo->delete();
        return $cargo;
    }

    public function getCargosActivos()
    {
        return Cargo::where('estado', 'Activo')->get();
    }
}