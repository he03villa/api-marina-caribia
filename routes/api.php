<?php

use App\Http\Controllers\BoletaServicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LanchasController;
use App\Http\Controllers\MotoNaveController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'boletas_servicios'
],function () {
    Route::get('/', [BoletaServicioController::class, 'index']);
    Route::get('/lista', [BoletaServicioController::class, 'getBoletasServicios']);
    Route::get('/{boleta}/pdf', [BoletaServicioController::class, 'descargarPdf']);
    Route::post('/', [BoletaServicioController::class, 'save'])->middleware(['validarCrearBolanteServicio']);
    Route::put('/{id}', [BoletaServicioController::class, 'update'])->middleware(['validarCambioEstado']);
});

Route::group([
    'prefix' => 'users'
],function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/save', [UserController::class, 'save'])->middleware(['validarCrearUser']);
    Route::get('/me', [UserController::class, 'me'])->middleware(['auth:api']);
});

Route::group([
    'prefix' => 'lanchas'
], function () {
    Route::get('/', [LanchasController::class, 'getLanchaByFiltro']);
    Route::get('/{id}', [LanchasController::class, 'getLancha']);
    Route::post('/', [LanchasController::class, 'createLancha'])->middleware(['validarCrearLancha']);
    Route::put('/{id}', [LanchasController::class, 'updateLancha'])->middleware(['validarCrearLancha']);
});

Route::group([
    'prefix' => 'clients'
], function () {
    Route::get('/', [ClienteController::class, 'getClienteByFiltro']);
    Route::get('/{id}', [ClienteController::class, 'getCliente']);
    Route::post('/', [ClienteController::class, 'createCliente'])->middleware(['validarCrearCliente']);
    Route::put('/{id}', [ClienteController::class, 'updateCliente'])->middleware(['validarCrearCliente']);
});

Route::group([
    'prefix' => 'motos_naves'
], function () {
    Route::get('/', [MotoNaveController::class, 'getMotoNaveByFilter']);
    Route::get('/{id}', [MotoNaveController::class, 'getMotoNave']);
    Route::post('/', [MotoNaveController::class, 'createMotoNave'])->middleware(['validarCrearMotoNave']);
    Route::put('/{id}', [MotoNaveController::class, 'updateMotoNave'])->middleware(['validarCrearMotoNave']);
});

Route::post('/login', [UserController::class, 'login'])->middleware(['validarLogin']);