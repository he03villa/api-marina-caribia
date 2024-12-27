<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidarCreacionTabajadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'identificacion' => 'required',
            'id_cargo' => 'required',
            'sexo' => 'required|in:Masculino,Femenino',
            'estado' => 'required|in:Activo,Inactivo',
        ], [
            'required' => 'El :attribute es requerido.',
            'in' => 'El :attribute debe ser un valor válido.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        return $next($request);
    }
}
