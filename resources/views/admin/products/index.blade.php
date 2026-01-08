<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Productos') }}
            </h2>

            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Crear Nuevo Producto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Imagen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Precio</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Acciones</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="h-16 w-16 object-cover rounded-md shadow">
                                @else
                                <div class="h-16 w-16 bg-gray-100 flex items-center justify-center rounded-md">
                                    📦
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ Str::limit($product->description, 50) }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold bg-gray-100 rounded-full">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    € {{ number_format($product->price, 2) }}
                                </div>

                                @if ($product->offer)
                                <div class="text-xs text-orange-600">
                                    -{{ $product->offer->discount_percentage }}%
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-indigo-600 hover:text-indigo-900 mr-4">
                                    Editar
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-400 text-4xl mb-4">📦</div>
                                <p class="text-gray-500 text-lg font-medium">
                                    No hay productos
                                </p>
                                <p class="text-gray-400 text-sm mt-2">
                                    Crea tu primer producto desde el panel de administración
                                </p>
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
