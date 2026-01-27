<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Historial de Pedidos') }}
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Items</th>
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
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->user->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->user->email }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">
                                    € {{ number_format($order->total_price, 2) }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    {{ $order->items->count() }} productos
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    @foreach($order->items->take(3) as $item)
                                        <div>- {{ $item->quantity }}x {{ Str::limit($item->product_name, 15) }}</div>
                                    @endforeach
                                    @if($order->items->count() > 3)
                                        <div>...</div>
                                    @endif
                                </div>
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
                                <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pedido? Esta acción no se puede deshacer.')">
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
                                    No hay pedidos registrados
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
