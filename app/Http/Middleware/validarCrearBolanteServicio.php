<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class validarCrearBolanteServicio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'moto_nave' => 'required',
            'destino' => 'required',
            'agencia' => 'required',
            'embarcacion' => 'required',
            'piloto' => 'required',
            'servicio' => 'required',
            'fecha_inicio' => 'required',
            'hora_inicio' => 'required',
            'fecha_final' => 'required',
            'hora_final' => 'required',
        ], [
            'required' => 'El :attribute es requerido.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        return $next($request);
    }
}
