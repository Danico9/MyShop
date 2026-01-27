<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===========================================
// RUTAS PÚBLICAS (Sin autenticación requerida)
// ===========================================

// Welcome page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Contact page
// Route::get('/contact', function () {                                                                                                                                                                                                                                                                     ││
//     return view('contact');                                                                                                                                                                                                                                                                              │ │
// })->name('contact');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas de categorías (solo lectura)
Route::resource('categories', CategoryController::class)
    ->only(['index', 'show']);

// Rutas de productos (solo lectura)
Route::get('/products-on-sale', [ProductController::class, 'onSale'])
    ->name('products.on-sale');

Route::resource('products', ProductController::class)
    ->only(['index', 'show']);

// Rutas de ofertas (solo lectura)
Route::resource('offers', OfferController::class)
    ->only(['index', 'show']);

// Rutas básicas del carrito de compras
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

// ===========================================
// RUTAS DEL CARRITO DE COMPRAS
// ===========================================

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

// Rutas avanzadas añadidas ahora:
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');    // Actualizar cantidad
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy'); // Eliminar un producto
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');  // Finalizar compra (vaciar)

// ===========================================
// RUTAS DE USUARIO AUTENTICADO (Breeze)
// ===========================================

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Mis Pedidos
    Route::get('/my-orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::delete('/my-orders/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===========================================
// RUTAS DE ADMINISTRACIÓN (Protegidas)
// ===========================================

// Route::middleware('auth')
//    ->prefix('admin')    // Todas las URLs empezarán por /admin/...
//    ->name('admin.')     // Todos los nombres de ruta empezarán por admin....
//    ->group(function () {
//
//        // Rutas de gestión de productos (CRUD completo excepto ver, que es público)
//        // Esta ruta apunta a un método nuevo 'adminIndex' que crearemos luego
//        Route::get('/products', [ProductController::class, 'adminIndex'])
//            ->name('products.index');
//
//        Route::resource('products', ProductController::class)
//            ->except(['index', 'show']); // Excluimos index y show porque ya son públicos
//
//        // NOTA: Las rutas de wishlist se añadirán en FASE 11
//    });

// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
//
//    // Rutas de gestión de productos
//    Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
//    Route::resource('products', ProductController::class)->except(['index', 'show']);
//
//    // Rutas para la lista de deseos (Wishlist) <-- AÑADIR ESTE BLOQUE
//    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
//    Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
//    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
// });

// ===========================================
// RUTAS DE ADMINISTRACIÓN (Protegidas + Logging)
// ===========================================
// Aquí añadimos 'log.activity' junto a 'auth'
Route::middleware(['auth', 'log.activity'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Rutas de gestión de productos
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
        Route::resource('products', ProductController::class)->except(['index', 'show']);

        // Rutas para la lista de deseos (Wishlist)
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    });

// Rutas de Super Admin (requiere rol de admin)
Route::middleware(['auth', 'log.activity', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/contact-messages', [ContactController::class, 'adminIndex'])->name('contact.index');
        Route::delete('/contact-messages/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // Rutas de Pedidos
        Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
        Route::delete('/orders/{id}', [\App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('orders.destroy');
    });

// Las rutas de autenticación (login, register, etc.) se incluyen desde aquí
require __DIR__.'/auth.php';
