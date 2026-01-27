<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Show all categories
     */
    public function index(): View
    {
        // Eloquent: Obtener todas las categorías
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show products from a specific category
     */
    public function show(string $id): View
    {
        if (! is_numeric($id) || $id < 1) {
            abort(404, 'ID de categoría inválido');
        }

        $category = Category::find($id);

        if (! $category) {
            abort(404, 'Categoría no encontrada');
        }

        // Obtener productos de esta categoría usando la relación
        $categoryProducts = $category->products()->with(['offer'])->get();

        return view('categories.show', compact('category', 'categoryProducts'));
    }
}
