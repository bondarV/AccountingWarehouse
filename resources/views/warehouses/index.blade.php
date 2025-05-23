<x-layout>
    <x-slot:title>Warehouses</x-slot:title>
    <x-slot:page>Warehouses</x-slot:page>

    @foreach($warehouses as $warehouse)
        <x-partials>
            <x-partials.title href="/warehouses/{{$warehouse['id']}}">
                {{$warehouse->title}}
            </x-partials.title>
            <x-partials.interactive-area.toggling :sections="[['name'=> 'inventory','color'=> 'blue','href'=> '/warehouses/'.$warehouse['id'].'/products'],'Transactions' => ['name'=>'transactions','color'=>'green','href'=>'/warehouses/'.$warehouse->id.'/transactions/'.$warehouse['id']]]"/>
    </x-partials>
    @endforeach

    <x-pagination>
        {{$warehouses->links()}}
    </x-pagination>
</x-layout>

