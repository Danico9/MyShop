<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controlador para la gestión de pedidos desde el panel de administración
 */
class AdminOrderController extends Controller
{
    /**
     * Muestra el listado de pedidos.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Se obtienen todos los pedidos ordenados por fecha de creación (los más recientes primero).
         *
         * - with(['user', 'items']): se utiliza eager loading para cargar
         *   las relaciones de usuario y los items del pedido y así evitar
         *   el problema N+1 de consultas.
         * - latest(): ordena por la columna created_at de forma descendente.
         */
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->get();

        // Se retorna la vista del listado de pedidos pasando la variable $orders
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Elimina un pedido concreto.
     *
     * @param int $id Identificador del pedido
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        /**
         * Se busca el pedido por su ID.
         *
         * - findOrFail(): si el pedido no existe, Laravel lanzará automáticamente
         *   una excepción 404.
         */
        $order = Order::findOrFail($id);

        // Se elimina el pedido de la base de datos
        $order->delete();

        /**
         * Se redirige al listado de pedidos mostrando un mensaje de éxito
         * en la sesión.
         */
        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Pedido eliminado correctamente.');
    }
}
