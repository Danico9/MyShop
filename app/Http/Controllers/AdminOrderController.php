<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class AdminOrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(): View
    {
        // Eager load user and items (with product) to minimize queries
        $orders = Order::with(['user', 'items'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id) : RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pedido eliminado correctamente.');
    }
}
