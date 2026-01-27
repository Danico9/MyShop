<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Muestra la vista del carrito de compras con los datos de la sesión.
     */
    public function index(): View
    {
        // Obtener el carrito de la sesión, o un array vacío si no existe
        $cart = session()->get('cart', []);

        // Obtenemos los IDs de los productos del carrito (las claves del array)
        $productIds = array_keys($cart);

        // Cargamos los modelos de producto con sus relaciones (Categoría y Oferta)
        // para poder mostrar nombres, precios y fotos reales
        $cartProducts = Product::with(['category', 'offer'])->find($productIds);

        // Añadimos la cantidad (que está en la sesión) a cada objeto Product
        // Esto nos permite usar $product->quantity en la vista fácilmente
        $cartProducts = $cartProducts->map(function ($product) use ($cart) {
            $product->quantity = $cart[$product->id]['quantity'];

            return $product;
        });

        return view('cart.index', [
            'cartProducts' => $cartProducts,
        ]);
    }

    /**
     * Añade un producto al carrito de compras en la sesión.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');

        // Recuperamos el carrito actual
        $cart = session()->get('cart', []);

        // Si el producto ya está, sumamos 1 a la cantidad
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Si no está, lo añadimos con cantidad 1
            $cart[$productId] = [
                'quantity' => 1,
            ];
        }

        // Guardamos el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->back()->with('success', '¡Producto añadido al carrito!');
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');

            session()->put('cart', $cart);

            return redirect()->route('cart.index')
                ->with('success', 'Cantidad actualizada correctamente.');
        }

        return redirect()->route('cart.index')
            ->with('error', 'El producto no se encontró en el carrito.');
    }

    /**
     * Elimina un producto del carrito de compras.
     */
    public function destroy(string $id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Elimina el elemento del array
            session()->put('cart', $cart); // Guarda el cambio

            return redirect()->route('cart.index')
                ->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->route('cart.index')
            ->with('error', 'El producto no se encontró en el carrito.');
    }

    /**
     * Simula la finalización de la compra, vaciando el carrito.
     */
    public function checkout(): RedirectResponse
    {
        // 1. Si el usuario NO está logueado: Simulación con mensaje diferenciado
        if (! auth()->check()) {
            session()->forget('cart');

            return redirect()->route('welcome')
                ->with('success', 'Compra simulada (Usuario no registrado).');
        }

        // 2. Si el usuario ESTÁ logueado: Procesar pedido real
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'El carrito está vacío.');
        }

        // Obtener productos reales para asegurar precios y nombres actuales
        $productIds = array_keys($cart);
        $products = Product::find($productIds);

        // Calcular total
        $total = 0;
        foreach ($products as $product) {
            $quantity = $cart[$product->id]['quantity'];
            // Aplicar lógica de oferta si existe (usando la lógica que ya podrías tener o el precio base)
            // Aquí usaremos el precio base del producto. Si tuvieras ofertas calculadas, úsalas aquí.
            $price = $product->price;
            // Si el producto tiene oferta aplicada dinámicamente, deberías calcularla aquí.
            // Asumiremos precio base por simplicidad o que el modelo Product tiene un método getFinalPriceAttribute
            // Vamos a recalcular ofertas básico si el modelo tuviera relación
            if ($product->offer) {
                $price = $product->price - ($product->price * ($product->offer->discount_percentage / 100));
            }

            $total += $price * $quantity;
        }

        // Crear la Orden
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'completed',
        ]);

        // Crear los Items de la Orden
        foreach ($products as $product) {
            $quantity = $cart[$product->id]['quantity'];

            // Recalcular precio unitario para guardarlo en el histórico
            $price = $product->price;
            if ($product->offer) {
                $price = $product->price - ($product->price * ($product->offer->discount_percentage / 100));
            }

            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
            ]);
        }

        // Vaciar carrito
        session()->forget('cart');

        return redirect()->route('welcome')
            ->with('success', 'Pedido registrado correctamente.');
    }
}
