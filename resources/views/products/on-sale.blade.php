<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔥 {{ __('Productos en Oferta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($products->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-500 text-lg">No hay ofertas activas en este momento.</p>
                        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">
                            Ver todos los productos
                        </a>
                    </div>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                        <x-product-card :product="$product">
                            <x-slot name="actions">
                                <div class="flex justify-between items-center mt-4">
                                            <span class="text-red-600 font-bold text-lg">
                                                -{{ $product->offer->discount_percentage }}%
                                            </span>

                                    <a href="{{ route('products.show', $product) }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                                        Ver Oferta
                                    </a>
                                </div>
                            </x-slot>
                        </x-product-card>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
