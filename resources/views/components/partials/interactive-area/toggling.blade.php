@props(['sections'])

<x-partials.interactive-area>

        @foreach($sections as $section)
            <a href="{{$section['href']}}"
               class="bg-{{$section['color']}}-600 hover:bg-{{$section['color']}}-500 text-white font-semibold p-4 rounded-lg shadow-md transition-all">
                {{ucfirst($section['name'])}}
            </a>
        @endforeach

</x-partials.interactive-area>
