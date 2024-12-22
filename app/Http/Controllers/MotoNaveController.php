<?php

namespace App\Http\Controllers;

use App\Dao\MotoNavesDao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotoNaveController extends Controller
{
    //
    protected $_MotoNaveDao;
    public function __construct(MotoNavesDao $MotoNaveDao) {
        $this->_MotoNaveDao = $MotoNaveDao;
    }

    public function index() {
        $motoNaves = $this->_MotoNaveDao->getMotoNavesActivas();
        return response()->json($motoNaves);
    }

    public function getMotoNave($id) {
        $motoNave = $this->_MotoNaveDao->getMotoNave($id);
        return response()->json($motoNave);
    }

    public function createMotoNave(Request $request) {
        $data = $request->all();
        $fecha = Carbon::now()->format('dmY-His');
        $data['id_moto_naves'] = $fecha;
        $motoNave = $this->_MotoNaveDao->createMotoNave($data);
        return response()->json($motoNave);
    }

    public function updateMotoNave(Request $request, $id) {
        $data = $request->all();
        $motoNave = $this->_MotoNaveDao->updateMotoNave($id, $data);
        return response()->json($motoNave);
    }

    public function deleteMotoNave($id) {
        $motoNave = $this->_MotoNaveDao->deleteMotoNave($id);
        return response()->json($motoNave);
    }

    public function getMotoNaveByFilter(Request $request) {
        $buscar = $request->get('buscar');
        $filtro = [
            'buscar' => $buscar,
        ];
        $motoNave = $this->_MotoNaveDao->getMotoNaveByFilter($filtro);
        return response()->json($motoNave);
    }
}
