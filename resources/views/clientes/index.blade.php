<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-200 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('clientes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo
                    Cliente</a>
            </div>
            <div class="mb-4">
                <input type="text" id="search-dni" placeholder="Buscar por DNI" class="border rounded p-2 w-full bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-200">
            </div>
            <div id="clientes-table">
                @include('clientes.partials.table', ['clientes' => $clientes])
            </div>
        </div>
    </div>
    <script>
        document.getElementById('search-dni').addEventListener('keyup', function () {
            let dni = this.value;
            fetch(`{{ route('clientes.index') }}?dni=${dni}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('clientes-table').innerHTML = html;
                });
        });
    </script>

</x-app-layout>