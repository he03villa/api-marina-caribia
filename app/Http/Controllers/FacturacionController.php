<?php

namespace App\Http\Controllers;

use App\Dao\FacturacionDao;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $fileName = 'facturas_' . now()->format('Y-m-d') . '.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $facturas = $this->FacturacionDao->get($id);

        $callback = function () use ($facturas) {
            $file = fopen('php://output', 'w');

            // Escribe los encabezados
            fputcsv($file, ['Cliente', 
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
                        ]);

            // Escribe los datos
            foreach ($facturas->detalle as $detalle) {
                fputcsv($file, [
                    $facturas->boleta->agencias->id_agencia,
                    '',
                    $detalle->concepto->codigo,
                    '',
                    $detalle->concepto->descripcion,
                    '0000000000',
                    $detalle->cantidad,
                    $detalle->valor_unitario,
                    0,
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
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    
}
