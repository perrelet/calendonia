@props([
    'tag' => 'div'
])
@if (empty($url))
<{{ $tag }} {{ $attributes }}>
@else
<a href='{{ $url }}' target='_blank' {{ $attributes }}>
@endif
    {{ $slot }}
@if (empty($url))
</{{ $tag }}>
@else
</a>
@endif