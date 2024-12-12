<?php

namespace App\Http\Controllers;

use App\Dao\UserDao;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $_UserDao;

    function __construct(UserDao $UserDao) {
        $this->_UserDao = $UserDao;
    }

    public function login(Request $request) {
        $dataR = $this->_UserDao->login($request->all());
        return response()->json($dataR['data'], $dataR['code']);
    }

    public function save(Request $request) {
        $res = $request->all();
        $data = [
            'name' => $res['name'],
            'email' =>$res['email'],
            'password' => bcrypt($res['password']),
            'perfil' => $res['perfil'],
            'estado' => $res['estado']
        ];
        $dataUser = $this->_UserDao->create($data);
        return response()->json($dataUser, 201);
    }

    public function me() {
        $data = $this->_UserDao->me();
        return response()->json($data, 200);
    }

    function index() {
        $data = $this->_UserDao->getAll();
        return response()->json($data, 200);
    }
}
