<?php

namespace App\Dao;

use App\Models\Facturas;
use Carbon\Carbon;

class FacturacionDao {
    public function getAll($filtro = null) {
        $buscar = "";
        $fechaInicio = "";
        $fechaFinal = "";
        if ($filtro) {
            $buscar = $filtro['buscar'] ?? "";
            $fechaInicio = $filtro['fecha_inicio'] ?? "";
            $fechaFinal = $filtro['fecha_fin'] ?? "";
        }
        $factura = Facturas::query();
        if ($buscar != "") {
            $factura = $factura->whereHas('boleta', function ($query) use ($buscar) {
                $query->whereHas('agencias', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                })
                ->orWhereHas('destinos', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                })
                ->orWhereHas('embarcaciones', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                })
                ->orWhereHas('motonaves', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                })
                ->orWhereHas('servicios', function ($query) use ($buscar) {
                    $query->where('nombre', 'like', '%' . $buscar . '%');
                });
            })
            ->orWhere('numero_factura', 'like', '%' . $buscar . '%');
        }
        /* if ($fechaInicio != "") {
            $factura = $factura->where('created_at', '>=', $fechaInicio);
        }
        if ($fechaFinal != "") {
            $factura = $factura->where('created_at', '<=', $fechaFinal);
        } */
        if ($fechaInicio != "" && $fechaFinal != "") {
            $fechaInicio = Carbon::parse($fechaInicio)->startOfDay();
            $fechaFinal = Carbon::parse($fechaFinal)->endOfDay();
            $factura = $factura->whereBetween('created_at', [$fechaInicio, $fechaFinal]);
        }
        $factura = $factura->with('detalle', 'boleta', 'boletas')->orderBy('id', 'desc')->get();
        return $factura;
    }

    public function get($id) {
        return Facturas::with('detalle', 'boleta')->find($id);
    }

    public function create($data) {
        $factura = Facturas::create($data);
        $factura->detalle()->createMany($data['detalles']);
        $factura->boletas()->sync($data['boleta']);
        return $factura;
    }

    public function update($id, $data) {
        $factura = Facturas::find($id);
        $factura->update($data);
        $factura->detalle()->delete();
        $factura->detalle()->createMany($data['detalles']);
        return $factura;
    }

    public function delete($id) {
        return Facturas::find($id)->delete();
    }
}