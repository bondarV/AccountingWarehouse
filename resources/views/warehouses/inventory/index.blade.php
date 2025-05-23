<x-layout>
    <x-slot:title>Inventory</x-slot:title>
    <x-slot:page>Inventory for {{$warehouse->title}}</x-slot:page>
    <x-slot:backButton>
        <x-return-back href="/warehouses/" />
    </x-slot:backButton>
    <x-entity-display-template.products :items="$products"/>
</x-layout>

