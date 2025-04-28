<?php

namespace App\Http\Controllers;

use App\Dao\AgenciasDao;
use App\Dao\Concepto_serviciosDao;
use Illuminate\Http\Request;

class ConseptoServiciosController extends Controller
{
    //
    protected $_ConseptoServiciosDao;
    protected $_AgenciasDao;

    public function __construct(Concepto_serviciosDao $ConseptoServiciosDao, AgenciasDao $AgenciasDao) {
        $this->_ConseptoServiciosDao = $ConseptoServiciosDao;
        $this->_AgenciasDao = $AgenciasDao;
    }

    public function index() {
        return $this->_ConseptoServiciosDao->getAll();
    }

    public function store(Request $request) {
        $req = $request->all();
        $data = [
            'concepto_servicio_id' => $req['concepto'],
            'puerto_or_destino_id' => $req['puerto'],
            'tarifa' => $req['tarifa']
        ];
        $concepto = $this->_ConseptoServiciosDao->save($data);
        return response()->json($concepto);
    }

    public function storeCliente(Request $request) {
        $req = $request->all();
        $data = [
            'concepto_servicio_id' => $req['concepto'],
            'agencia_id' => $req['cliente'],
            'tarifa' => $req['tarifa']
        ];
        $concepto = $this->_AgenciasDao->saveTarifas($data);
        return response()->json($concepto);
    }
}
