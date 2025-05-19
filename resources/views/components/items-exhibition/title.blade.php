@props(['href'])
<div class="flex w-1/5">
    <a href="{{$href}}" class="text-lg font-medium text-blue-600 hover:underline">
        {{$slot}}
    </a>
</div>
