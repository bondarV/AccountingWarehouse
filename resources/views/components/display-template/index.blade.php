@props([
    'items',
    'href',
    'labelField' => 'title',
    'labelSource' => 'self',
    'quantityField' => 'quantity',
    'header' => 'Items',
])

@if(count($items))
    <h2 class="font-bold">{{ $header }}</h2>

    @foreach($items as $item)
        @php
            $displayLabel = $labelSource === 'product'
                ? optional($item->product)->$labelField
                : $item->$labelField;

            $displayQuantity = $quantityField === 'pivot.quantity'
                ? optional($item->pivot)->quantity
                : $item->quantity;

            $warehouseId = optional($item)->id;
            $productId = null;
            $warehouseId = null;
            if($labelSource === 'self'){
                $productId= $item->id;
                $warehouseId = optional($item)->id;
            }else{
                $productId= optional($item->product)->id;
                $warehouseId = optional($item->warehouse)->id;
            }


            $operateHref = "/warehouses/$warehouseId/products/$productId/transactions/create";
            $titleHref = '/' . $href . '/' . $productId;
        @endphp

        <x-items-exhibition>
            <x-items-exhibition.title :href="$titleHref">
                {{ $displayLabel }}
            </x-items-exhibition.title>

            <div class="text-center">
                <strong>Quantity -</strong>
                <span class="bg-gray-200 text-gray-700 rounded-full px-2 py-1 text-sm font-semibold">
                    {{ $displayQuantity }}
                </span>
            </div>
            <x-items-exhibition.interactive-area.toggling
                    :sections="[
        [
            'name' => 'Operate',
            'href' => $operateHref,
            'color' => 'purple'
        ]
    ]"
            />
        </x-items-exhibition>

    @endforeach
@else
    <p class="text-gray-500">The storage currently is completely empty</p>
@endif
