<x-layout>
    <x-slot:title>Products</x-slot:title>
    <x-slot:page>
        Products
    </x-slot:page>
    @foreach($products as $product)
        <x-items-exhibition>


        <x-items-exhibition.title href="/product/{{$product['id']}}">
            {{$product->name}}
        </x-items-exhibition.title>
        </x-items-exhibition>
            @endforeach
            <x-pagination>
                {{$products->links()}}
            </x-pagination>
</x-layout>
