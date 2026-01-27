<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Muestra la lista de pedidos del usuario autenticado.
     */
    public function index(): View
    {
        // Reutilizamos la lógica, pero filtramos por el usuario actual
        $orders = Order::where('user_id', auth()->id())
            ->with('items') // Cargamos los items para ver el resumen
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Elimina un pedido propio.
     */
    public function destroy($id): RedirectResponse
    {
        // Buscamos el pedido asegurándonos de que pertenezca al usuario logueado
        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail(); // Si no es tuyo o no existe, da error 404

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Pedido eliminado de tu historial.');
    }
}
