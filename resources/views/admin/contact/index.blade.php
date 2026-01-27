<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mensajes de Contacto') }}
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Asunto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Mensaje</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Fecha</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Acciones</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($messages as $message)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $message->name }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ $message->email }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $message->subject }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 max-w-xs truncate" title="{{ $message->message }}">
                                    {{ $message->message }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right text-sm">
                                <form action="{{ route('admin.contact.destroy', $message->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este mensaje?')">
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
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400 text-4xl mb-4">📧</div>
                                <p class="text-gray-500 text-lg font-medium">
                                    No hay mensajes
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
