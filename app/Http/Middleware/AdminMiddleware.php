<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware que restringe el acceso únicamente a usuarios administradores
 */
class AdminMiddleware
{
    /**
     * Maneja una petición entrante.
     *
     * @param Request $request Petición HTTP actual
     * @param Closure $next    Continuación del flujo de la petición
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Se comprueba que:
         * - El usuario esté autenticado.
         * - El usuario tenga el atributo is_admin activo.
         *
         * auth()->check(): verifica si hay un usuario logueado.
         * auth()->user(): obtiene el usuario autenticado.
         *
         * Si no se cumple alguna de estas condiciones,
         * se bloquea el acceso devolviendo un error 403 (Forbidden).
         */
        if (! auth()->check() || ! auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        /**
         * Si el usuario es administrador, la petición continúa
         * hacia el controlador o la siguiente capa del middleware.
         */
        return $next($request);
    }
}
