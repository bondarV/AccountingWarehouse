<x-layout>
    <x-slot:title>
        {{trim(ucfirst($product['name']))}}
    </x-slot:title>
    <h1>{{$product['name']}}</h1>
    <p>: {{$general_quantity}}</p>
    <button><a href="/products">Back</a></button>
</x-layout>
