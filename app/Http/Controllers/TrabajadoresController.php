<?php

namespace App\Http\Controllers;

use App\Dao\TrabajadoresDao;
use Illuminate\Http\Request;

class TrabajadoresController extends Controller
{
    //
    protected $_trabajadoresDao;

    public function __construct(TrabajadoresDao $trabajadoresDao)
    {
        $this->_trabajadoresDao = $trabajadoresDao;
    }

    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        $trabajadores = $this->_trabajadoresDao->getTrabajadoresFilterEndPoint($filtro);
        return response()->json($trabajadores, 200);
    }

    public function trabajador($id) {
        $trabajador = $this->_trabajadoresDao->getTrabajador($id);
        return response()->json($trabajador, 200);
    }

    public function createTrabajador(Request $request) {
        $trabajador = $this->_trabajadoresDao->createTrabajador($request->all());
        return response()->json($trabajador, 200);
    }

    public function updateTrabajador(Request $request, $id) {
        $trabajador = $this->_trabajadoresDao->updateTrabajador($id, $request->all());
        return response()->json($trabajador, 200);
    }

    public function deleteTrabajador($id) {
        $trabajador = $this->_trabajadoresDao->deleteTrabajador($id);
        return response()->json($trabajador, 200);
    }
}
