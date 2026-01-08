<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
    public function create(): View
    {
        // Cargar todas las categorías y ofertas para los selectores del formulario
        $categories = Category::all();
        $offers = Offer::all();

        // Retornamos la vista que crearemos en el siguiente paso
        return view('admin.products.create', compact('categories', 'offers'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        // PASO 1: Validar todos los datos del formulario
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:products,name',
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Máx 2MB
            'price'       => 'required|numeric|min:0|max:999999.99',
            'category_id' => 'required|exists:categories,id',
            'offer_id'    => 'nullable|exists:offers,id',
        ], [
            // Mensajes de error personalizados
            'name.required'        => 'El nombre del producto es obligatorio.',
            'name.unique'          => 'Ya existe un producto con ese nombre.',
            'description.required' => 'La descripción es obligatoria.',
            'image.image'          => 'El archivo debe ser una imagen.',
            'image.mimes'          => 'La imagen debe ser de tipo: jpeg, png, jpg, webp.',
            'image.max'            => 'La imagen no debe superar los 2MB.',
            'price.required'       => 'El precio es obligatorio.',
            'price.numeric'        => 'El precio debe ser un número.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists'   => 'La categoría seleccionada no es válida.',
            'offer_id.exists'      => 'La oferta seleccionada no es válida.',
        ]);

        // PASO 2: Procesar la imagen si fue subida
        if ($request->hasFile('image')) {
            // Guardar en el disco 'public' dentro de la carpeta 'products'
            // Laravel genera automáticamente un nombre único (hash) para el archivo
            $imagePath = $request->file('image')->store('products', 'public');

            // Guardamos la ruta en el array de datos validados
            $validated['image'] = $imagePath;
        }

        // PASO 3: Crear el producto con los datos validados
        // Usamos create() que asigna masivamente los campos definidos en $fillable del Modelo
        Product::create($validated);

        // PASO 4: Redirigir con mensaje de éxito (usando el sistema flash que creamos antes)
        return redirect()->route('admin.products.index')
            ->with('success', '¡Producto creado exitosamente!');
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
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Product $product): View
    {
        // Cargar todas las categorías y ofertas para los selectores del formulario
        $categories = Category::all();
        $offers = Offer::all();

        return view('admin.products.edit', compact('product', 'categories', 'offers'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // PASO 1: Validar los datos del formulario
        $validated = $request->validate([
            // unique:products,name,ID -> Ignora el ID actual para evitar falso error de duplicado
            'name'        => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price'       => 'required|numeric|min:0|max:999999.99',
            'category_id' => 'required|exists:categories,id',
            'offer_id'    => 'nullable|exists:offers,id',
        ]);

        // PASO 2: Manejar la subida de la nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior del disco si existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // PASO 3: Actualizar el producto
        $product->update($validated);

        // PASO 4: Redirigir con mensaje
        return redirect()->route('admin.products.index')
            ->with('success', '¡Producto actualizado exitosamente!');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // PASO 1: Eliminar la imagen asociada del disco si existe
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // PASO 2: Eliminar el registro de la BD
        $product->delete();

        // PASO 3: Redirigir
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Muestra la lista de productos en el panel de administración.
     */
    public function adminIndex(): View
    {
        $products = Product::with(['category', 'offer'])
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }
}
