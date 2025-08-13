<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Editar Cliente</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST"
            class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block">DNI</label>
                <input type="text" name="dni" class="w-full border rounded p-2 bg-white dark:bg-gray-800"
                    value="{{ old('dni', $cliente->dni) }}">
                @error('dni') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block">Asesorado por:</label>
                <select name="asesorado" class="w-full border rounded p-2 bg-white dark:bg-gray-900">
                    <option value="">Seleccionar medio</option>
                    <option value="w3" {{ old('asesorado', $cliente->asesorado ?? '') == 'w3' ? 'selected' : '' }}>
                        Whatsapp x3</option>
                    <option value="w7" {{ old('asesorado', $cliente->asesorado ?? '') == 'w7' ? 'selected' : '' }}>
                        Whatsapp x7</option>
                    <option value="sucursal" {{ old('asesorado', $cliente->asesorado ?? '') == 'sucursal' ? 'selected' : '' }}>Sucursal</option>
                    <option value="call" {{ old('asesorado', $cliente->asesorado ?? '') == 'call' ? 'selected' : '' }}>
                        Llamado</option>
                </select>
                @error('asesorado') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block">Teléfono</label>
                <input type="text" name="telefono" class="w-full border rounded p-2 bg-white dark:bg-gray-800"
                    value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            <button class="bg-yellow-600 text-white px-4 py-2 rounded">Actualizar</button>
            <a href="{{ route('clientes.index') }}" class="ml-2 bg-red-500 py-2.5 px-4 rounded">Cancelar</a>
        </form>
    </div>
</x-app-layout>