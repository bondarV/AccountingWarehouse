<x-layout>
    <x-slot:title>Warehouses</x-slot:title>
    <x-slot:page>Warehouses</x-slot:page>

    @foreach($warehouses as $warehouse)
        <x-items-exhibition>
            <x-items-exhibition.title href="/warehouse/{{$warehouse['id']}}">
                {{$warehouse->title}}
            </x-items-exhibition.title>
            <x-items-exhibition.interactive itemId="{{$warehouse->id}}" :sections="['Inventory','Transactions']"/>
        </x-items-exhibition>
    @endforeach

    <x-pagination>
        {{$warehouses->links()}}
    </x-pagination>
</x-layout>
