<x-layout>
    <x-slot:title>
        {{trim(ucfirst($product['title']))}}
    </x-slot:title>
    <h1>{{$product['title']}}</h1>
    <p>На складі лишилося рівно: {{$product['amount']}}</p>
    <button><a href="/products">Back</a></button>
</x-layout>
