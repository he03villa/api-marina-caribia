<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class validaCrearUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'name' => 'required|min:3|max:20',
            'perfil' => 'required|in:Administrador,Operador,Operativo Tablet',
            'estado' => 'required|in:Activo,Inactivo',
        ], [
            'required' => 'El :attribute es requerido.',
            'email' => 'El :attribute debe ser un correo electrónico válido.',
            'unique' => 'El :attribute ya está en uso.',
            'min' => 'El :attribute debe tener al menos :min caracteres.',
            'max' => 'El :attribute debe tener como máximo :max caracteres.',
            'confirmed' => 'Las contraseñas no coinciden.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        return $next($request);
    }
}
