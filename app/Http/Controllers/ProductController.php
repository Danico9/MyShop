<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Eloquent: Obtenemos todos los productos con sus relaciones
        $products = Product::with(['category', 'offer'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Display only products that have an active offer
     */
    public function onSale(): View
    {
        // Eloquent: Filtramos donde offer_id no sea nulo
        $products = Product::whereNotNull('offer_id')
            ->with(['category', 'offer'])
            ->get();

        return view('products.on-sale', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // En una aplicación real, aquí se mostraría un formulario.
        return redirect()->route('products.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // En una aplicación real, aquí se guardaría en la BD.
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // Validar formato ID
        if (!is_numeric($id) || $id < 1) {
            abort(404, 'ID de producto inválido');
        }

        // Eloquent: Buscar por ID incluyendo categoría y oferta
        $product = Product::with(['category', 'offer'])->find($id);

        if (!$product) {
            abort(404, 'Producto no encontrado');
        }

        // Pasamos el producto a la vista (la categoría ya va dentro del objeto $product)
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('products.show', $id)
            ->with('success', 'Producto editado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('products.show', $id)
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
