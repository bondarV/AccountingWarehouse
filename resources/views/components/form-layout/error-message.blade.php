@props(['name'])
@error($name)
<div  class="pt-2 text-red-600 italic font-bold error">{{ $message }}</div>
@enderror
