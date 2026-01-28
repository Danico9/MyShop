<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controlador encargado de la gestión de pedidos del usuario autenticado
 */
class OrderController extends Controller
{
    /**
     * Muestra la lista de pedidos del usuario actualmente autenticado.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Se obtienen únicamente los pedidos que pertenecen al usuario logueado.
         *
         * - auth()->id(): devuelve el ID del usuario autenticado.
         * - where('user_id', ...): filtra los pedidos por ese usuario.
         * - with('items'): se cargan los items del pedido mediante eager loading
         *   para poder mostrar un resumen sin realizar consultas adicionales.
         * - latest(): ordena los pedidos por fecha de creación (descendente).
         */
        $orders = Order::where('user_id', auth()->id())
            ->with('items')
            ->latest()
            ->get();

        // Se retorna la vista del listado de pedidos pasando la variable $orders
        return view('orders.index', compact('orders'));
    }

    /**
     * Elimina un pedido del historial del usuario.
     *
     * @param int $id Identificador del pedido
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        /**
         * Se busca el pedido asegurándose de que:
         * - Exista en la base de datos
         * - Pertenezca al usuario autenticado
         *
         * firstOrFail(): si no se cumple alguna de las condiciones,
         * Laravel lanzará automáticamente un error 404.
         */
        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        // Se elimina el pedido de la base de datos
        $order->delete();

        /**
         * Se redirige al listado de pedidos del usuario mostrando
         * un mensaje de confirmación.
         */
        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido eliminado de tu historial.');
    }
}
