<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    /**
     * Show all offers
     */
    public function index(): View
    {
        // Eloquent: Obtener todas las ofertas
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
    }

    /**
     * Show products with a specific offer
     */
    public function show(string $id): View
    {
        if (!is_numeric($id) || $id < 1) {
            abort(404, 'ID de oferta inválido');
        }

        $offer = Offer::find($id);

        if (!$offer) {
            abort(404, 'Oferta no encontrada');
        }

        // Obtener productos asociados a esta oferta
        $offerProducts = $offer->products()->with(['category'])->get();

        return view('offers.show', compact('offer', 'offerProducts'));
    }
}
