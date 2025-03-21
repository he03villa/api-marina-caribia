<?php

namespace App\Http\Controllers;

use App\Dao\Concepto_serviciosDao;
use Illuminate\Http\Request;

class ConseptoServiciosController extends Controller
{
    //
    protected $_ConseptoServiciosDao;

    public function __construct(Concepto_serviciosDao $ConseptoServiciosDao) {
        $this->_ConseptoServiciosDao = $ConseptoServiciosDao;
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
}
