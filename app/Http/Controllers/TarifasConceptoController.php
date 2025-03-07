<?php

namespace App\Http\Controllers;

use App\Dao\TarifasConceptoDao;
use Illuminate\Http\Request;

class TarifasConceptoController extends Controller
{
    //
    protected $_tarifasConceptoDao;

    public function __construct(TarifasConceptoDao $tarifasConceptoDao) {
        $this->_tarifasConceptoDao = $tarifasConceptoDao;
    }

    public function getAll() {
        return $this->_tarifasConceptoDao->getAll();
    }

    public function get($id) {
        return $this->_tarifasConceptoDao->get($id);
    }

    public function create(Request $request) {
        return $this->_tarifasConceptoDao->create($request->all());
    }

    public function update($id, Request $request) {
        return $this->_tarifasConceptoDao->update($id, $request->all());
    }

    public function delete($id) {
        return $this->_tarifasConceptoDao->delete($id);
    }

    public function deleteAll() {
        return $this->_tarifasConceptoDao->deleteAll();
    }

    public function macibo(Request $request) {
        return $this->_tarifasConceptoDao->macibo($request->all());
    }
}
