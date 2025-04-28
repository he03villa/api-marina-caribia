<?php

namespace App\Http\Controllers;

use App\Dao\AgenciasDao;
use App\Dao\ClienteDao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    protected $_ClienteDao;
    protected $_agenciasDao;
    public function __construct(ClienteDao $ClienteDao, AgenciasDao $agenciasDao) {
        $this->_ClienteDao = $ClienteDao;
        $this->_agenciasDao = $agenciasDao;
    }

    public function index() {
        $clientes = $this->_ClienteDao->getClientes();
        return response()->json($clientes, 200);
    }

    public function getClienteByFiltro(Request $request) {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        $clientes = $this->_agenciasDao->getAgenciaByFiltro($filtro);
        return response()->json($clientes, 200);
    }

    public function createCliente(Request $request) {
        $data = $request->all();
        /* $fecha = Carbon::now()->format('dmY-His');
        $data['id_cliente'] = $fecha; */
        $cliente = $this->_agenciasDao->createAgencia($data);
        return response()->json($cliente, 200);
    }

    public function updateCliente(Request $request, $id) {
        $data = $request->all();
        $cliente = $this->_agenciasDao->updateAgencia($id, $data);
        return response()->json($cliente, 200);
    }

    public function deleteCliente($id) {
        $cliente = $this->_agenciasDao->deleteAgencia($id);
        return response()->json($cliente, 200);
    }

    public function getCliente($id) {
        $cliente = $this->_agenciasDao->getAgencia($id);
        return response()->json($cliente, 200);
    }
}
