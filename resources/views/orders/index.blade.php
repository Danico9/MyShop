<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Pedidos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">ID Pedido</th>
                            {{-- Columna Usuario Eliminada --}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Productos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Fecha</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Acciones</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">
                                    #{{ $order->id }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">
                                    € {{ number_format($order->total_price, 2) }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-700">
                                    {{ $order->items->count() }} {{ $order->items->count() == 1 ? 'producto' : 'productos' }}
                                </div>
                                <ul class="mt-1 space-y-1">
                                    @foreach($order->items as $item)
                                        <li class="text-xs text-gray-500 flex items-center">
                                            <span class="inline-flex items-center justify-center bg-gray-100 rounded px-1.5 py-0.5 font-bold text-gray-700 mr-2">
                                                {{ $item->quantity }}x
                                            </span>
                                            <span class="truncate max-w-[150px]" title="{{ $item->product_name }}">
                                                {{ $item->product_name }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right text-sm">
                                <form action="{{ route('orders.destroy', $order->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Seguro que quieres borrar este pedido de tu historial?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 font-medium">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400 text-4xl mb-4">🛍️</div>
                                <p class="text-gray-500 text-lg font-medium">
                                    Aún no has realizado ningún pedido
                                </p>
                                <a href="{{ route('welcome') }}" class="text-indigo-600 hover:text-indigo-900 text-sm mt-2 inline-block">
                                    Ir a comprar
                                </a>
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
