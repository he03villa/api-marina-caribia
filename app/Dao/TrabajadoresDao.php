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
        return Trabajador::with('cargo')->where('estado', 'Activo')->orderBy('nombre', 'asc')->get();
    }

    public function getTrabajadoresFilterEndPoint($filtro) {
        $buscar = "";
        if ($filtro) {
            $buscar = $filtro['buscar'] ?? "";
        }
        $trabajadores = Trabajador::query();
        if ($buscar != "") {
            $trabajadores = $trabajadores->where('id', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('identificacion', 'like', '%' . $buscar . '%')
                ->orWhere('sexo', 'like', '%' . $buscar . '%')
                ->orWhere('estado', 'like', '%' . $buscar . '%')
                ->orWhereHas('cargo', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                });
        }
        $trabajadores = $trabajadores->with('cargo:id,nombre')->orderBy('id', 'desc')->get();
        return $trabajadores;
    }
}