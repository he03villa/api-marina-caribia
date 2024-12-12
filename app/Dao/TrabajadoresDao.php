<?php

namespace App\Dao;
use App\Models\Trabajador;

class TrabajadoresDao
{
    public function getTrabajadores()
    {
        return Trabajador::all();
    }

    public function getTrabajador($id)
    {
        return Trabajador::find($id);
    }

    public function createTrabajador($data)
    {
        return Trabajador::create($data);
    }

    public function updateTrabajador($id, $data)
    {
        $trabajador = Trabajador::find($id);
        $trabajador->update($data);
        return $trabajador;
    }

    public function deleteTrabajador($id)
    {
        $trabajador = Trabajador::find($id);
        $trabajador->delete();
        return $trabajador;
    }

    public function getTrabajadorFilter()
    {
        return Trabajador::with('cargo')->orderBy('nombre', 'asc')->get();
    }
}