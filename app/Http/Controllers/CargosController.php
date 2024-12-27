<?php

namespace App\Http\Controllers;

use App\Dao\CargoDao;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    //
    protected $_CargosDao;

    public function __construct(CargoDao $CargosDao)
    {
        $this->_CargosDao = $CargosDao;
    }

    public function index()
    {
        $cargos = $this->_CargosDao->getCargos();
        return response()->json($cargos, 200);
    }

    public function cargosActivos() {
        $cargos = $this->_CargosDao->getCargosActivos();
        return response()->json($cargos, 200);
    }
}
