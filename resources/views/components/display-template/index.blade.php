@props([
    'items',
    'href',
    'labelField' => 'title',
    'labelSource' => 'self',
    'quantityField' => 'quantity',

])@if(count($items))
    <h2 class="font-bold">{{$header}}</h2>
    @foreach($items as $item)
        <x-items-exhibition>
            <x-items-exhibition.title
                :href="'/' . $href . '/' . ($labelSource === 'product' ? $item->product->id : $item->id)">
                {{
        $labelSource === 'product'
             ? $item->product->$labelField
                                      : $item->$labelField
                }}
            </x-items-exhibition.title>
            <div class=" text-center">
                <strong>
                    Quantity -
                </strong>
                <span class=" bg-gray-200 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
 {{
                        $quantityField === 'pivot.quantity'
                            ? optional($item->pivot)->quantity
                            : $item->quantity
                    }}
    </span>
            </div>
            <x-items-exhibition.interactive-area
                :sections="[['name'=>'Operate','color'=>'purple','href'=>'/transactions/create']]"/>


        </x-items-exhibition>
    @endforeach
@else
    <p>The storage currently is completely empty</p>
@endif
