@props(['warehouses'])
@if(count($warehouses))
    <h2 class="font-bold">Warehouses</h2>
    @foreach($warehouses as $warehouse)
        <x-items-exhibition>
            <x-items-exhibition.title :href="'/warehouses/'.$warehouse['id']">
                {{$warehouse->title}}
            </x-items-exhibition.title>
            <div class=" text-center">
                <strong>
                    Quantity -
                </strong>
                <span class=" bg-gray-200 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
        {{ $warehouse->pivot->quantity }}

    </span>
            </div>
            <x-items-exhibition.interactive-area
                                                 :sections="[['name'=>'Operate','color'=>'purple','href'=>'/transactions/create']]"/>


    </x-items-exhibition>
    @endforeach
@else
    <p>The storage currently is completely empty</p>
@endif
