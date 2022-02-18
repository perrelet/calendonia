@props([
    'tag' => 'div'
])
@if (empty($url))
<{{ $tag }} class='{{ $class }}'>
@else
<a href='{{ $url }}' target='_blank' class='{{ $class }}'>
@endif
    {{ $slot }}
@if (empty($url))
</{{ $tag }}>
@else
</a>
@endif