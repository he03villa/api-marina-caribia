<?php

namespace App\Http\Controllers;

use App\Dao\ClienteDao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    protected $_ClienteDao;
    public function __construct(ClienteDao $ClienteDao) {
        $this->_ClienteDao = $ClienteDao;
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
        $clientes = $this->_ClienteDao->getClienteByFiltro($filtro);
        return response()->json($clientes, 200);
    }

    public function createCliente(Request $request) {
        $data = $request->all();
        $fecha = Carbon::now()->format('dmY-His');
        $data['id_cliente'] = $fecha;
        $cliente = $this->_ClienteDao->createCliente($data);
        return response()->json($cliente, 200);
    }

    public function updateCliente(Request $request, $id) {
        $data = $request->all();
        $cliente = $this->_ClienteDao->updateCliente($id, $data);
        return response()->json($cliente, 200);
    }

    public function deleteCliente($id) {
        $cliente = $this->_ClienteDao->deleteCliente($id);
        return response()->json($cliente, 200);
    }

    public function getCliente($id) {
        $cliente = $this->_ClienteDao->getCliente($id);
        return response()->json($cliente, 200);
    }
}
