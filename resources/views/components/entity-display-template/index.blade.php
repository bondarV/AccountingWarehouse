@props(['itemHref','label','quantity','operateHref'])

<x-partials>
    <x-partials.title :href="$itemHref">
        {{ $label }}
    </x-partials.title>
        <div class="text-center grow self-center flex-1 ">
            <strong>Quantity -</strong>
            <span class="bg-gray-444 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
    {{ $quantity }}
</span>
    </div>
    <x-partials.interactive-area.toggling
        :sections="[
        [
            'name' => 'Operate',
            'href' => $operateHref,
            'color' => 'purple'
        ]
    ]"
    />
</x-partials>
