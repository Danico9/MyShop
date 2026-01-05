<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Show cart overview
     */
    public function index(): View
    {
        // Simulamos usuario ID 1 (ya que aún no hay login)
        $userId = 1;
        $user = User::find($userId);

        // Obtenemos los productos del carrito a través de la relación N:M
        // Si el usuario no existe (ej. tras un fresh seed), devolvemos array vacío para evitar error
        $cartProducts = $user ? $user->products : [];

        return view('cart.index', [
            'cartProducts' => $cartProducts
        ]);
    }

    public function store(Request $request)
    {
        return redirect()->route('cart.index')
            ->with('success', 'Producto añadido al carrito exitosamente');
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('cart.index')
            ->with('success', 'Cantidad actualizada exitosamente');
    }
}
