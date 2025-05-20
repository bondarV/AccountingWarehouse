@props(['warehouses','product'])
@if(count($warehouses))
    <h2 class=" font-bold text-2xl ml-3">
        Warehouses
    </h2>
    @foreach($warehouses as $warehouse)
        <x-entity-display-template
            :itemHref="'/warehouses/'.$warehouse->id"
            :label="$warehouse->title"
            :quantity="$warehouse->pivot->quantity"
            :operateHref="'/warehouses/'.$warehouse->id.'/products/'.$product->id.'/transactions/create'"
        />
    @endforeach
    <x-pagination>
        {{$warehouses->links()}}
    </x-pagination>
@else
    <x-item-absence/>
@endif
