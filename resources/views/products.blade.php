<x-layout>
    <x-slot:title>Products</x-slot:title>
    <x-slot:page>
        Products
    </x-slot:page>
    <p>products</p>
    <ul>
        @foreach($products as $product)
            <li class="mx-10">
                <a href="/products/{{$product['id']}}"> {{$product['name']}}:
                    <strong>{{$product['price']}}</strong></a>
            </li>
        @endforeach
    </ul>
    <div>
        {{$products->links()}}
    </div>
</x-layout>
