<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Formulario de Edición --}}
                    {{-- NOTA: enctype es OBLIGATORIO para subir archivos --}}
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- Importante: Simula una petición PUT para actualizar --}}

                        {{-- Nombre del Producto --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                            {{-- old('name', $product->name): Si hay error de validación usa lo que escribió el usuario, si no, usa el de la BD --}}
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Imagen del Producto --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>

                            {{-- Previsualización de la imagen actual --}}
                            @if ($product->image)
                            <div class="my-2 p-2 border rounded-md bg-gray-50 inline-block">
                                <p class="text-xs text-gray-500 mb-1">Imagen actual:</p>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen actual" class="h-32 w-auto object-cover rounded">
                            </div>
                            @endif

                            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/gif"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Deja este campo vacío si no quieres cambiar la imagen.</p>
                            @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Precio --}}
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio (€)</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Categoría --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select name="category_id" id="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Oferta (Opcional) --}}
                        <div>
                            <label for="offer_id" class="block text-sm font-medium text-gray-700">Oferta (Opcional)</label>
                            <select name="offer_id" id="offer_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Sin oferta</option>
                                @foreach($offers as $offer)
                                <option value="{{ $offer->id }}"
                                        {{ old('offer_id', $product->offer_id) == $offer->id ? 'selected' : '' }}>
                                {{ $offer->name }} (-{{ $offer->discount_percentage }}%)
                                </option>
                                @endforeach
                            </select>
                            @error('offer_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Actualizar Producto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
