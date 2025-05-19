<x-layout>
    <x-slot:title>
        {{ ucfirst(trim($product->name)) }}
    </x-slot:title>
    <x-slot:page>
        Description
    </x-slot:page>
    <x-slot:backButton>
        <x-return-back>
        </x-return-back>
    </x-slot:backButton>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>

        <p class="text-gray-700 mb-4">
            <strong>Description:</strong><br>
            {{ $product->description }}
        </p>

        <p class="text-gray-700 mb-2">
            <strong>Price:</strong> ${{ number_format($product->price, 2) }}
        </p>

        <p class="text-gray-700 mb-4">
            <strong>Cost:</strong> ${{ number_format($product->cost, 2) }}
        </p>

        <p class="text-gray-700 mb-4">
            <strong>Total Quantity in Stock:</strong> {{ $general_quantity }}
        </p>
    </div>
    <x-warehouses-per-product :warehouses="$product->warehouses" />

</x-layout>
