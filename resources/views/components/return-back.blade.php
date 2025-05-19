@props(['destination' =>null])
@if(!$destination)
    <a href="{{ url()->previous() }}"
       class="ml-auto text-blue-600 hover:text-blue-800 hover:underline font-semibold">
        &larr; Back
    </a>
@else
    <a href="{{$destination}}"
       class="ml-auto text-blue-600 hover:text-blue-800 hover:underline font-semibold">
        &larr; Back
    </a>
@endif
