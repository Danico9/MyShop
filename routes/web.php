<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CartController;

// Ruta principal (Home)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Rutas de Productos
Route::get('/products-on-sale', [ProductController::class, 'onSale'])->name('products.on-sale');
Route::resource('products', ProductController::class);

// Rutas de Categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Rutas de Ofertas
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');

// Rutas del Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

// Ruta de Contacto
//Route::get('/contact', function () {
//    return view('contact');
//})->name('contact');
// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
