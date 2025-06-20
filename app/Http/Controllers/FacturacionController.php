<?php

namespace App\Http\Controllers;

use App\Dao\FacturacionDao;
use App\Exports\FacturaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FacturacionController extends Controller
{
    //
    protected $FacturacionDao;

    public function __construct(FacturacionDao $FacturacionDao) {
        $this->FacturacionDao = $FacturacionDao;
    }

    public function index(Request $request) {
        $buscar = $request->get('buscar');
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');
        $filtro = [
            'buscar' => $buscar,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ];
        $faturas = $this->FacturacionDao->getAll($filtro);
        return response()->json($faturas, 200);
    }

    public function get($id) {
        $factura = $this->FacturacionDao->get($id);
        return response()->json($factura, 200);
    }

    public function create(Request $request) {
        $req = $request->all();
        $req['numero_factura'] = $this->generarNumeroFacturaUUID();
        $req['boleta'] = $req['boleta_servicio_id'];
        unset($req['boleta_servicio_id']);
        $factura = $this->FacturacionDao->create($req);
        return response()->json($factura, 201);
    }

    public function update($id, Request $request) {
        $factura = $this->FacturacionDao->update($id, $request->all());
        return response()->json($factura, 200);
    }

    public function delete($id) {
        $factura = $this->FacturacionDao->delete($id);
        return response()->json($factura, 200);
    }

    function generarNumeroFacturaUUID()
    {
        return 'FAC-' . Str::uuid()->toString();
    }

    public function exportCSV($id)
    {
        $fileName = 'facturas_' . now()->format('Y-m-d') . '.xlsx';

        $headers = [
            'Cliente', 
            'Razon Social', 
            'Concepto', 
            'Nombre', 
            'Descripcion', 
            'Documento', 
            'Cantidad', 
            'ValorUnitario', 
            'PorcentajeDescuento', 
            'ProcentajeIVA', 
            'TasaCambio', 
            'TipoFactura', 
            'NumeroFactura', 
            'Vencimiento', 
            'Referencia', 
            'Proveedor', 
            'CambioEnIVAyBase',
            'NumeroValorIVA',
            'CambioEnIVAyBase',
            'NumeroValorIVA',
            'NumeroValorBase',
        ];

        $facturas = $this->FacturacionDao->get($id);

        $data = $facturas->detalle->map(function ($detalle) use ($facturas) {
            return [
                ($facturas->boleta ? $facturas->boleta->agencias->id_agencia : $facturas->boletas->first()->agencias->id_agencia),
                '',
                $detalle->concepto->codigo,
                '',
                $detalle->concepto->descripcion,
                '0000000000',
                $detalle->cantidad,
                $detalle->valor_unitario,
                $facturas->descuento,
                0,
                0,
                'FA',
                0,
                '',
                '',
                '',
                'N',
                '0',
                '0',
                '',
                ''
            ];
        });

        return Excel::download(new FacturaExport($data, $headers), $fileName);
    }

    
}
