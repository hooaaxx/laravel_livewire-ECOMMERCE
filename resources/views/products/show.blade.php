<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shirt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-7 bg-gray-200 border-b border-gray-200">
                    @livewire('show-product', [
                        'products' => $products,
                    ])
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
    </x-slot>
</x-app-layout>
