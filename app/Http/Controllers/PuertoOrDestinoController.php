<?php

namespace App\Http\Controllers;

use App\Dao\PuertosOrDestinoDao;
use Illuminate\Http\Request;

class PuertoOrDestinoController extends Controller
{
    //
    protected $_puertoOrDestinoDao;

    /**
     * PuertoOrDestinoController constructor.
     * @param PuertosOrDestinoDao $puertoOrDestinoDao
     */
    public function __construct(PuertosOrDestinoDao $puertoOrDestinoDao)
    {
        $this->_puertoOrDestinoDao = $puertoOrDestinoDao;
    }

    public function getAll() {
        return $this->_puertoOrDestinoDao->getAll();
    }

    public function get($id) {
        return $this->_puertoOrDestinoDao->getPuertoOrDestino($id);
    }

    public function create(Request $request) {
        return $this->_puertoOrDestinoDao->createPuertoOrDestino($request->all());
    }

    public function update($id, Request $request) {
        return $this->_puertoOrDestinoDao->updatePuertoOrDestino($id, $request->all());
    }

    public function delete($id) {
        return $this->_puertoOrDestinoDao->deletePuertoOrDestino($id);
    }

    public function puertoServicios($id) {
        return $this->_puertoOrDestinoDao->getPuertoServicio($id);
    }

    public function getPuertoDestinoFiltro(Request $request) {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        return $this->_puertoOrDestinoDao->getPuertoDestinoFiltro($filtro);
    }

    public function updateServicios($id, Request $request) {
        return $this->_puertoOrDestinoDao->updateServicios($id, $request->all());
    }
}
