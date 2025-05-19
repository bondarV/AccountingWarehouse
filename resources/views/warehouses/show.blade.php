<x-layout>
    <x-slot:title>
        {{$warehouse->title}}
    </x-slot:title>
    <x-slot:page>
        {{'In-depth info about: '.$warehouse->title}}
    </x-slot:page>
    <x-slot:backButton>
        <x-return-back destination="/warehouses/">
        </x-return-back>
    </x-slot:backButton>
    <x-warehouse-item-exhibition>
        <x-slot:code>
            {{$warehouse->code}}
        </x-slot:code>
        <x-slot:region>
            {{$warehouse->region}}
        </x-slot:region>
        <x-slot:location>
            {{$warehouse->location}}
        </x-slot:location>
    </x-warehouse-item-exhibition>
    <x-display-template.product-per-warehouse :items="$items"/>
</x-layout>
