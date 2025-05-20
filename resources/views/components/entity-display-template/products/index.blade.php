@props(['items'])
@if(count($items))
    <h2 class="border-y-2 py-2 text-center border-black font-bold text-2xl ml-3">
        Products
    </h2>
    @foreach($items as $item)
        <x-entity-display-template
            :itemHref="'/products/'.$item->product->id"
            :label="$item->product->name"
            :quantity="$item->quantity"
            :operateHref="'/warehouses/'.$item->warehouse->id.'/products/'.$item->product->id.'/transactions/create'"
        >
        </x-entity-display-template>
    @endforeach
    <x-pagination>
        {{$items->links()}}
    </x-pagination>
@else
    <x-item-absence/>
@endif
