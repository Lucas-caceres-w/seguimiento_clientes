<table class="w-full border-collapse text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 shadow-md rounded">
            <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="p-3">DNI</th>
                                    <th class="p-3">Teléfono</th>
                                    <th class="p-3">Asesorado</th>
                                    <th class="p-3">Ultima actualización</th>
                                    <th class="p-3">Duración</th>
                                    <th class="p-3">Vencimiento</th>
                                    <th class="p-3">Acciones</th>
                        </tr>
            </thead>
            <tbody>
                        @forelse($clientes as $cliente)
                                                                                    <tr>
                                                                                                                        <td class="p-3">{{ $cliente->dni }}</td>
                                                                                                                        <td class="p-3">{{ $cliente->telefono }}</td>
                                                                                                                        <td class="p-3 capitalize">
                                                                                                                                                            @if (in_array($cliente->asesorado, ['w3', 'w7']))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                whatsapp
                                                                                                                                                                                                                                                                                                                                                                                                                                                            @elseif (in_array($cliente->asesorado, ['call']))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                llamada
                                                                                                                                                                                                                                                                                                                                                                                                                                                            @else
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {{ $cliente->asesorado }}
                                                                                                                                                                                                                                                                                                                                                                                                                                                            @endif

                                                                                                                        </td>
                                                                                                                        <td class="p-3">{{ $cliente->updated_at->format('d / m / y') }}</td>
                                                                                                                        <td class="p-3">{{ $cliente->duracion }} dias</td>
                                                                                                                        <td class="p-3">
                                                                                                                                                            {{ $cliente->updated_at->copy()->addDays($cliente->duracion)->format('d/m/Y') }}
                                                                                                                        </td>
                                                                                                                        <td class="p-3 flex gap-2">
                                                                                                                                                            <a href="{{ route('clientes.edit', $cliente) }}"
                                                                                                                                                                                                class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                                                                                                                                                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                                                                                                                                                                                onsubmit="return confirm('¿Eliminar este cliente?')">
                                                                                                                                                                                                @csrf
                                                                                                                                                                                                @method('DELETE')
                                                                                                                                                                                                <button
                                                                                                                                                                                                                                    class="bg-red-500 text-white px-3 py-1 rounded">Eliminar</button>
                                                                                                                                                            </form>
                                                                                                                        </td>
                                                                                    </tr>
                                                                        @empty
                                                                                    <tr>
                                                                                                                        <td colspan="4" class="p-3 text-center">No hay clientes registrados</td>
                                                                                    </tr>
                                                                        @endforelse
            </tbody>
</table>
<div class="mt-4">
            {{ $clientes->links() }}
</div>