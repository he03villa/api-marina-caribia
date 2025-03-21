<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class validarGuardarConceptoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'puerto' => 'required',
            'concepto' => 'required',
            'tarifa' => 'required|numeric',
        ], [
            'required' => 'El :attribute es requerido.',
            'numeric' => 'El :attribute debe ser un número.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        return $next($request);
    }
}
