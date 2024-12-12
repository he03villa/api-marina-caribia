<?php

use App\Http\Controllers\BoletaServicioController;
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
});

Route::group([
    'prefix' => 'users'
],function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/save', [UserController::class, 'save'])->middleware(['validarCrearUser']);
    Route::get('/me', [UserController::class, 'me'])->middleware(['auth:api']);
});


Route::post('/login', [UserController::class, 'login'])->middleware(['validarLogin']);