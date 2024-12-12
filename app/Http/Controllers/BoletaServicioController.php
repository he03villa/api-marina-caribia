<?php

namespace App\Http\Controllers;

use App\Dao\AgenciasDao;
use App\Dao\BoletaServicioDao;
use App\Dao\LanchasDao;
use App\Dao\MotoNavesDao;
use App\Dao\PilotosDao;
use App\Dao\ServiciosDao;
use App\Dao\TrabajadoresDao;
use App\Models\BoletaServicio;
use App\Models\PuertoOrDestino;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class BoletaServicioController extends Controller
{
    //
    protected $_AgenciasDao;
    protected $_LanchasDao;
    protected $_MotoNavesDao;
    protected $_PilotosDao;
    protected $_ServiciosDao;
    protected $_BoletaServicioDao;
    protected $_TrabajadoresDao;

    /**
     * Inicializa los objetos de acceso a datos necesarios para
     * esta clase.
     *
     * @param AgenciasDao $AgenciasDao
     * @param LanchasDao $LanchasDao
     * @param MotoNavesDao $MotoNavesDao
     * @param PilotosDao $PilotosDao
     * @param ServiciosDao $ServiciosDao
     * @param BoletaServicioDao $BoletaServicioDao
     */
    public function __construct(AgenciasDao $AgenciasDao, LanchasDao $LanchasDao, MotoNavesDao $MotoNavesDao, PilotosDao $PilotosDao, ServiciosDao $ServiciosDao, BoletaServicioDao $BoletaServicioDao, TrabajadoresDao $TrabajadoresDao)
    {
        $this->_AgenciasDao = $AgenciasDao;
        $this->_LanchasDao = $LanchasDao;
        $this->_MotoNavesDao = $MotoNavesDao;
        $this->_PilotosDao = $PilotosDao;
        $this->_ServiciosDao = $ServiciosDao;
        $this->_BoletaServicioDao = $BoletaServicioDao;
        $this->_TrabajadoresDao = $TrabajadoresDao;
    }

    /**
     * Muestra la lista de opciones para la boleta de servicio.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $agencias = $this->_AgenciasDao->getAgenciasActivas();
        $lanchas = $this->_LanchasDao->getLanchasActivas();
        $motoNaves = $this->_MotoNavesDao->getMotoNavesActivas();
        $pilotos = $this->_PilotosDao->getPilotosActivas();
        $puertosDestinos = PuertoOrDestino::where('estado', 'Activo')->get();
        $servicios = $this->_ServiciosDao->getServiciosActivos();
        $trabajador = $this->_TrabajadoresDao->getTrabajadorFilter();
        $trabajador = $trabajador->map(function ($trabajador) {
            return [
                'id' => $trabajador->id,
                'nombres' => $trabajador->nombre,
                'cargo' => $trabajador->cargo->nombre
            ];
        });

        return response()->json([
            'agencias' => $agencias, 
            'lanchas' => $lanchas, 
            'motoNaves' => $motoNaves, 
            'pilotos' => $pilotos, 
            'puertosDestinos' => $puertosDestinos, 
            'servicios' => $servicios, 
            'trabajador' => $trabajador
        ], 200);
    }

    /**
     * Registra una nueva boleta de servicio en la base de datos.
     * 
     * @param Request $request Contiene los datos de la boleta de servicio a registrar.
     * 
     * @return \Illuminate\Http\JsonResponse El registro de la boleta de servicio en formato JSON.
     */
    public function save(Request $request) {
        $req = $request->all();
        $req['fecha_inicio'] = Carbon::parse($req['fecha_inicio'])->format('Y-m-d');
        $req['fecha_final'] = Carbon::parse($req['fecha_final'])->format('Y-m-d');
        $req['hora_inicio'] = Carbon::parse($req['hora_inicio'])->format('H:i:s');
        $req['hora_final'] = Carbon::parse($req['hora_final'])->format('H:i:s');
        $req['id_boleta_servicio'] = Carbon::now()->timestamp;
        $dataRegistro = $this->_BoletaServicioDao->createBoletaServicio($req);
        return response()->json($dataRegistro, 200);
    }

    public function getBoletasServicios() {
        $arrayBoletasServicios = $this->_BoletaServicioDao->getBoletaServiciosFilter();
        $dataBoletasServicios = $arrayBoletasServicios->map(function ($boletaServicio) {
            $salida = Carbon::createFromFormat('Y-m-d H:i:s', "$boletaServicio->fecha_inicio $boletaServicio->hora_inicio");
            $regreso = Carbon::createFromFormat('Y-m-d H:i:s', "$boletaServicio->fecha_final $boletaServicio->hora_final");
            $diferencia = $salida->diff($regreso);
            $duracion = $diferencia->format('%H:%I:%S');
            return [
                'id' => $boletaServicio->id,
                'id_boleta_servicio' => $boletaServicio->id_boleta_servicio,
                'fecha_salida' => $boletaServicio->fecha_inicio,
                'fecha_regreso' => $boletaServicio->fecha_final,
                'hora_salida' => $boletaServicio->hora_inicio,
                'hora_regreso' => $boletaServicio->hora_final,
                'lancha' => $boletaServicio->embarcaciones->nombre,
                'destino' => $boletaServicio->destinos->nombre,
                'piloto' => $boletaServicio->pilotos->nombre,
                'motonave' => $boletaServicio->motonaves ? $boletaServicio->motonaves->nombre : '',
                'servicio' => $boletaServicio->servicios->nombre,
                'estado' => $boletaServicio->estado,
                'duracion' => $duracion
            ];
        });

        return response()->json($dataBoletasServicios, 200);
    }


    function descargarPdf(BoletaServicio $boleta) {
        $dataPDF = [
            'id_boleta_servicio' => $boleta->id_boleta_servicio,
            'fecha_salida' => $boleta->fecha_inicio,
            'fecha_regreso' => $boleta->fecha_final,
            'hora_salida' => $boleta->hora_inicio,
            'hora_regreso' => $boleta->hora_final,
            'lancha' => $boleta->embarcaciones->nombre,
            'destino' => $boleta->destinos->nombre,
            'piloto' => $boleta->pilotos->nombre,
            'motonave' => $boleta->motonaves ? $boleta->motonaves->nombre : '',
            'servicio' => $boleta->servicios->nombre,
            'observaciones' => $boleta->observaciones,
            'agencia' => $boleta->agencias->nombre
        ];
        return response()->streamDownload(function () use ($dataPDF) {
            echo Pdf::loadHTML(
                Blade::render('pdf.boleta-servicio', ['dataPDF' => $dataPDF, 'title' => 'Boleta de servicio'])
            )
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait')
            ->stream();
        }, Carbon::today() . '.pdf');
    }
    
}
