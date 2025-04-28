<?php

use App\Http\Controllers\BoletaServicioController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConseptoServiciosController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\LanchasController;
use App\Http\Controllers\MotoNaveController;
use App\Http\Controllers\PuertoOrDestinoController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TarifasConceptoController;
use App\Http\Controllers\TrabajadoresController;
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
    Route::put('/{id}/facturacion', [BoletaServicioController::class, 'updateFacturacion'])->middleware(['validarCambioFacturacion']);
    Route::delete('/{id}', [BoletaServicioController::class, 'delete']);
    Route::get('/boteasIsNotFactures', [BoletaServicioController::class, 'getAllBoletasIsNotFactures']);
    Route::get('/{id}', [BoletaServicioController::class, 'getBoletaServicio']);
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

Route::group([
    'prefix' => 'cargos'
], function () {
    Route::get('/', [CargosController::class, 'index']);
    //Route::get('/activos', [CargosController::class, 'cargosActivos']);
});

Route::group([
    'prefix' => 'trabajadores'
], function () {
   Route::get('/', [TrabajadoresController::class, 'index']);
   Route::get('/{id}', [TrabajadoresController::class, 'trabajador']);
   Route::post('/', [TrabajadoresController::class, 'createTrabajador'])->middleware(['validarCrearTrabajador']);
   Route::put('/{id}', [TrabajadoresController::class, 'updateTrabajador'])->middleware(['validarCrearTrabajador']);
});

Route::group([
    'prefix' => 'tarifas_conceptos'
], function () {
    Route::get('/', [TarifasConceptoController::class, 'getAll']);
    Route::get('/{id}', [TarifasConceptoController::class, 'get']);
    Route::post('/', [TarifasConceptoController::class, 'create'])->middleware(['validarCrearTarifaConcepto']);
    Route::put('/{id}', [TarifasConceptoController::class, 'update'])->middleware(['validarCrearTarifaConcepto']);
    Route::delete('/{id}', [TarifasConceptoController::class, 'delete']);
    Route::delete('/', [TarifasConceptoController::class, 'deleteAll']);
    Route::post('/macibo', [TarifasConceptoController::class, 'macibo']);
});

Route::group([
    'prefix' => 'puertos_or_destinos'
], function () {
    Route::get('/', [PuertoOrDestinoController::class, 'getPuertoDestinoFiltro']);
    /* Route::get('/{id}', [TarifasController::class, 'get']);
    Route::post('/', [TarifasController::class, 'create'])->middleware(['validarCrearTarifa']);
    Route::put('/{id}', [TarifasController::class, 'update'])->middleware(['validarCrearTarifa']);
    Route::delete('/{id}', [TarifasController::class, 'delete']); */
    Route::put('/{id}/servicios', [PuertoOrDestinoController::class, 'updateServicios'])->middleware(['validarActualizarServicios']);
    Route::get('/{id}/servicios', [PuertoOrDestinoController::class, 'puertoServicios']);
});

Route::group([
    'prefix' => 'facturas'
], function () {
    Route::get('/', [FacturacionController::class, 'index']);
    Route::get('/{id}', [FacturacionController::class, 'get']);
    Route::post('/', [FacturacionController::class, 'create'])->middleware(['validarCrearFactura']);
    Route::put('/{id}', [FacturacionController::class, 'update'])->middleware(['validarCrearFactura']);
    Route::delete('/{id}', [FacturacionController::class, 'delete']);
    Route::get('/{id}/export', [FacturacionController::class, 'exportCSV']);
});

Route::group([
    'prefix' => 'servicios'
], function () {
    Route::get('/', [ServiciosController::class, 'getServiciosFiltro']);
    Route::get('/{id}', [ServiciosController::class, 'show']);
    Route::post('/', [ServiciosController::class, 'store'])->middleware(['validarCrearServicio']);
    Route::put('/{id}', [ServiciosController::class, 'update'])->middleware(['validarCrearServicio']);
    Route::delete('/{id}', [ServiciosController::class, 'destroy']);
});

Route::group([
    'prefix' => 'conceptos'
], function () {
    Route::get('/', [ConseptoServiciosController::class, 'index']);
    Route::post('/', [ConseptoServiciosController::class, 'store']);
    Route::post('/cliente', [ConseptoServiciosController::class, 'storeCliente']);
});

Route::post('/login', [UserController::class, 'login'])->middleware(['validarLogin']);