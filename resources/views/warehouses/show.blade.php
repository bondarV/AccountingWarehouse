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
    @if(count($items))
        <h2 class=" font-bold text-2xl ml-3">
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
        <x-entity-display-template.absence/>
    @endif

</x-layout>
