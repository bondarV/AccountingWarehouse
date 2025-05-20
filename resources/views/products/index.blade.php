<x-layout>
    <x-slot:title>Products</x-slot:title>
    <x-slot:page>
        Products
    </x-slot:page>
    @foreach($products as $product)

        <x-partials>
            @php
                $sections =[['name'=> 'Destroy','color'=> 'red','href'=> '/erase/'.$product['id']]];
            @endphp
            <x-partials.title href="/products/{{$product['id']}}">
                {{$product->name}}
            </x-partials.title>
                <x-partials.interactive-area. :sections="$sections"/>
        </x-partials>
    @endforeach
    <x-pagination>
        {{$products->links()}}
    </x-pagination>
</x-layout>
