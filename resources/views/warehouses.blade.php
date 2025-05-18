<x-layout>
    <x-slot:title>Warehouses</x-slot:title>
    <x-slot:page>Warehouses</x-slot:page>

    @foreach($warehouses as $warehouse)
        <x-items-exhibition>
            <x-items-exhibition.title href="/warehouse/{{$warehouse['id']}}">
                {{$warehouse->title}}
            </x-items-exhibition.title>
            <x-items-exhibition.interactive-area :sections="[['name'=> 'inventory','color'=> 'blue','href'=> '/inventories/'.$warehouse['id']],'Transactions' => ['name'=>'transactions','color'=>'green','href'=>'/transactions/'.$warehouse['id']]]"/>
        </x-items-exhibition>
    @endforeach

    <x-pagination>
        {{$warehouses->links()}}
    </x-pagination>
</x-layout>
