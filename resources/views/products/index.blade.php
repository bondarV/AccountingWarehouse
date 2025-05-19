<x-layout>
    <x-slot:title>Products</x-slot:title>
    <x-slot:page>
        Products
    </x-slot:page>
    @foreach($products as $product)

        <x-items-exhibition>
            @php
                $sections =[['name'=> 'Destroy','color'=> 'red','href'=> '/erase/'.$product['id']]];
            @endphp
            <x-items-exhibition.title href="/products/{{$product['id']}}">
                {{$product->name}}
            </x-items-exhibition.title>
                <x-items-exhibition.interactive-area. :sections="$sections"/>
        </x-items-exhibition>
    @endforeach
    <x-pagination>
        {{$products->links()}}
    </x-pagination>
</x-layout>
