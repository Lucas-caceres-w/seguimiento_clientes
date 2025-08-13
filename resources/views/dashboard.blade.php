<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido") }}
                </div>
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white text-gray-900 dark:text-gray-100 p-6 rounded shadow dark:bg-gray-800">
                    <h3 class="text-lg font-bold mb-4">Bienvenido {{ Auth::user()->name }}</h3>

                    <p class="mb-4">Desde aquí podés administrar tus clientes.</p>

                    <a href="{{ route('clientes.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Ver clientes
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>