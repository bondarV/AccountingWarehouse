<x-layout>
    <x-slot:title>Inventory</x-slot:title>
    <x-slot:page>Inventory for {{$warehouse->title}}</x-slot:page>
    <x-slot:backButton>
        <x-return-back>
        </x-return-back>
    </x-slot:backButton>
    <x-product-per-warehouse :items="$inventory"/>
        <x-pagination>
            {{$inventory->links()}}
        </x-pagination>
</x-layout>

