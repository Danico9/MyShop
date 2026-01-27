<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page with featured content
     */
    public function index(): View
    {
        // Productos destacados: Los 3 primeros que tengan oferta
        $featuredProducts = Product::with(['category', 'offer'])
            ->whereNotNull('offer_id')
            ->take(3)
            ->get();

        // Categorías destacadas: Las 4 primeras
        $featuredCategories = Category::take(4)->get();

        return view('welcome', compact('featuredProducts', 'featuredCategories'));
    }
}
