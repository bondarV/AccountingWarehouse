<x-layout>
    <x-slot:title>
        {{$warehouse->title}}
    </x-slot:title>
    <x-slot:page>
        {{'In-depth info about: '.$warehouse->title}}
    </x-slot:page>
    <x-slot:backButton>
        <x-return-back>
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
    @if(count($items))
        <h2 class="font-bold">Products</h2>
        <x-items-exhibition>
            @foreach($items as $item)
                <x-items-exhibition.title :href="'/products/'.$item->product['id']">
                    {{$item->product->name}}
                </x-items-exhibition.title>
                <div>
                    <strong>
                        Quantity -
                    </strong>
                    <span class=" bg-gray-200 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
        {{ $item->quantity }}

    </span>
                </div>
                <x-items-exhibition.interactive-area a
                                                     :sections="[['name'=>'Operate','color'=>'purple','href'=>'/transactions/create']]"/>
            @endforeach

        </x-items-exhibition>
    @else
        <p>The storage currently is completely empty</p>
    @endif
</x-layout>
