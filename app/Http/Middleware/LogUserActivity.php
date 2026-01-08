<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ejecutar la petición y obtener la respuesta primero
        $response = $next($request);

        // 2. Si el usuario está autenticado, registrar su actividad después
        if (auth()->check()) {
            Log::info('Actividad de usuario', [
                'user_id'   => auth()->id(),
                'user_name' => auth()->user()->name,
                'method'    => $request->method(),
                'url'       => $request->fullUrl(),
                'ip'        => $request->ip(),
            ]);
        }

        return $response;
    }
}
