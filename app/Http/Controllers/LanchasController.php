<?php

namespace App\Http\Controllers;

use App\Dao\LanchasDao;
use Illuminate\Http\Request;

class LanchasController extends Controller
{
    //
    protected $_LanchasDao;

    public function __construct(LanchasDao $LanchasDao)
    {
        $this->_LanchasDao = $LanchasDao;
    }

    public function index()
    {
        $lanchas = $this->_LanchasDao->getLanchasActivas();
        return response()->json($lanchas, 200);
    }

    public function getLanchaByFiltro(Request $request)
    {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        $lanchas = $this->_LanchasDao->getLanchaByFiltro($filtro);
        return response()->json($lanchas, 200);
    }

    public function getLancha($id)
    {
        $lancha = $this->_LanchasDao->getLancha($id);
        return response()->json($lancha, 200);
    }

    public function createLancha(Request $request)
    {
        $data = $request->all();
        $lancha = $this->_LanchasDao->createLancha($data);
        return response()->json($lancha, 200);
    }

    public function updateLancha(Request $request, $id)
    {
        $data = $request->all();
        $lancha = $this->_LanchasDao->updateLancha($id, $data);
        return response()->json($lancha, 200);
    }

    public function deleteLancha($id)
    {
        $lancha = $this->_LanchasDao->deleteLancha($id);
        return response()->json($lancha, 200);
    }
}
