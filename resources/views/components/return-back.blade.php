@props(['href'])

<a href="{{ $href ?? url()->previous() }}"
    {{ $attributes->merge(['class' => 'ml-auto text-blue-600 hover:text-blue-800 hover:underline font-semibold']) }}>
    {!! trim($slot) !== '' ? $slot : '&larr; Back' !!}
</a>
