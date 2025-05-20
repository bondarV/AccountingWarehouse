<x-layout>
    <x-slot:title>
        {{$warehouse->title}}
    </x-slot:title>
    <x-slot:page>
        {{'In-depth info about: '.$warehouse->title}}
    </x-slot:page>
    <x-slot:backButton>
        <x-return-back href="/warehouses/"/>
    </x-slot:backButton>
    <x-entity-display-template.warehouses.data>
        <x-slot:code>
            {{$warehouse->code}}
        </x-slot:code>
        <x-slot:region>
            {{$warehouse->region}}
        </x-slot:region>
        <x-slot:location>
            {{$warehouse->location}}
        </x-slot:location>
    </x-entity-display-template.warehouses.data>
    <x-entity-display-template.products :items="$items"/>
</x-layout>
