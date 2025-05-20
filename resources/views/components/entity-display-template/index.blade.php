@props(['itemHref','label','quantity','operateHref'])

<x-items-exhibition>
    <x-items-exhibition.title :href="$itemHref">
        {{ $label }}
    </x-items-exhibition.title>


        <div class="text-center">
            <strong>Quantity -</strong>
            <span class="bg-gray-444 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
    {{ $quantity }}
</span>
    </div>
    <x-items-exhibition.interactive-area.toggling
        :sections="[
        [
            'name' => 'Operate',
            'href' => $operateHref,
            'color' => 'purple'
        ]
    ]"
    />
</x-items-exhibition>
