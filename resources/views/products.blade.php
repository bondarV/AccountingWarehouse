<x-layout>
    <x-slot:title>Products</x-slot:title>

    <p>products</p>
    <ul>
        @foreach($products as $product)
            <li class="mx-10">
                <a href="/products/{{$product['id']}}"> {{$product['title']}}:
                    <strong>{{$product['amount']}}</strong></a>
            </li>
        @endforeach
    </ul>
</x-layout>
