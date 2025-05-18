@props(['itemId','sections'])

<div class="flex gap-2">
    <a href="/inventories/{{$itemId}}"
       class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
        {{$sections[0]}}
    </a>
    <a href="/transactions/{{$itemId}}"
       class="bg-green-600 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
        {{$sections[1]}}
    </a>
</div>
