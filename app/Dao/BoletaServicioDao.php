<?php

namespace App\Dao;
use App\Models\BoletaServicio;

class BoletaServicioDao
{
    public function getBoletaServicio($id)
    {
        return BoletaServicio::find($id);
    }

    public function updateBoletaServicio($id, $data)
    {
        $boletaServicio = BoletaServicio::find($id);
        $boletaServicio->update($data);
        return $boletaServicio;
    }

    public function deleteBoletaServicio($id)
    {
        $boletaServicio = BoletaServicio::find($id);
        $boletaServicio->delete();
        return $boletaServicio;
    }

    public function getBoletaServicios()
    {
        return BoletaServicio::all();
    }

    public function createBoletaServicio($data)
    {
        return BoletaServicio::create($data);
    }

    public function getBoletaServiciosFilter()
    {
        return BoletaServicio::orderBy('id', 'desc')->get();
    }
}