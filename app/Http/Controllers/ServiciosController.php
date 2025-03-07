<?php

namespace App\Http\Controllers;

use App\Dao\ServiciosDao;
use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    //
    protected $_serviciosDao;

    public function __construct(ServiciosDao $serviciosDao)
    {
        $this->_serviciosDao = $serviciosDao;
    }

    public function index()
    {
        $servicios = $this->_serviciosDao->getAll();
        return response()->json($servicios, 200);
    }

    public function show($id)
    {
        $servicios = $this->_serviciosDao->getById($id);
        return response()->json($servicios, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data = [
            'nombre' => $data['nombre'],
            'id_servicio' => $data['codigo'],
            'estado' => $data['estado'],
            'concepto_servicios' => $data['concepto_servicios'],
        ];
        $servicios = $this->_serviciosDao->create($data);
        return response()->json($servicios, 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = [
            'nombre' => $data['nombre'],
            'id_servicio' => $data['codigo'],
            'estado' => $data['estado'],
            'concepto_servicios' => $data['concepto_servicios'],
        ];
        $servicios = $this->_serviciosDao->update($id, $data);
        return response()->json($servicios, 200);
    }

    public function destroy($id)
    {
        $servicios = $this->_serviciosDao->delete($id);
        return response()->json($servicios, 200);
    }

    public function getServiciosFiltro(Request $request) {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        $servicios = $this->_serviciosDao->getServiciosFilter($filtro);
        return response()->json($servicios, 200);
    }
}
