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
        $boleta = BoletaServicio::create($data);
        $boleta->trabajadores()->sync($data['trabajadores']);
        return $boleta;
    }

    public function getBoletaServiciosFilter($filtro = null)
    {
        $buscar = "";
        $lancha = "";
        $destino = "";
        $piloto = "";
        $motoNave = "";
        $servicio = "";
        $estado = "";
        $fechaInicio = "";
        $fechaFinal = "";
        if ($filtro) {
            $buscar = $filtro['buscar'] ?? "";
            $lancha = $filtro['lancha'] ?? "";
            $destino = $filtro['destino'] ?? "";
            $piloto = $filtro['piloto'] ?? "";
            $motoNave = $filtro['motoNave'] ?? "";
            $servicio = $filtro['servicio'] ?? "";
            $estado = $filtro['estado'] ?? "";
            $fechaInicio = $filtro['fecha_salida'] ?? "";
            $fechaFinal = $filtro['fecha_regreso'] ?? "";
        }
        $boletaServicios = BoletaServicio::query();
        if ($buscar != '') {
            $boletaServicios = $boletaServicios->whereHas('embarcaciones', function ($query) use ($buscar) {
                                    $query->where('nombre', 'like', '%' . $buscar . '%');
                                })
                                ->orWhereHas('destinos', function ($query) use ($buscar) {
                                    $query->where('nombre', 'like', '%' . $buscar . '%');
                                })
                                ->orWhereHas('pilotos', function ($query) use ($buscar) {
                                    $query->where('nombre', 'like', '%' . $buscar . '%');
                                })
                                ->orWhereHas('motonaves', function ($query) use ($buscar) {
                                    $query->where('nombre', 'like', '%' . $buscar . '%');
                                })
                                ->orWhereHas('servicios', function ($query) use ($buscar) {
                                    $query->where('nombre', 'like', '%' . $buscar . '%');
                                })
                                ->orWhere('estado', 'like', '%' . $buscar . '%');
        }
        if ($lancha != '') {
            $boletaServicios = $boletaServicios->where('embarcacion', $lancha);
        }
        if ($destino != '') {
            $boletaServicios = $boletaServicios->where('destino', $destino);
        }
        if ($piloto != '') {
            $boletaServicios = $boletaServicios->where('piloto', $piloto);
        }
        if ($motoNave != '') {
            $boletaServicios = $boletaServicios->where('embarcacion', $motoNave);
        }
        if ($servicio != '') {
            $boletaServicios = $boletaServicios->where('servicio', $servicio);
        }
        if ($estado != '') {
            $boletaServicios = $boletaServicios->where('estado', $estado);
        }
        if ($fechaInicio != '') {
            $boletaServicios = $boletaServicios->whereDate('fecha_inicio', '=', $fechaInicio);
        }
        if ($fechaFinal != '') {
            $boletaServicios = $boletaServicios->whereDate('fecha_final', '=', $fechaFinal);
        }
        if ($fechaInicio != '' && $fechaFinal != '') {
            $boletaServicios = $boletaServicios->whereDate('fecha_inicio', '>=', $fechaInicio)->whereDate('fecha_final', '<=', $fechaFinal);
        }
        $boletaServicios = $boletaServicios->orderBy('fecha_inicio', 'desc')->orderBy('hora_inicio', 'desc')->get();
        return $boletaServicios;
    }
}