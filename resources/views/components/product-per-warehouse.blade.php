@props(['items'])
@if(count($items))
    <h2 class="font-bold">Products</h2>
    @foreach($items as $item)
        <x-items-exhibition>

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

        </x-items-exhibition>
    @endforeach

@else
    <p>The storage currently is completely empty</p>
@endif
