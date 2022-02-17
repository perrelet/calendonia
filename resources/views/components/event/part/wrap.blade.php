@if (empty($url))
<div class='event'>
@else
<a href='{{ $url }}' target='_blank' class='event'>
@endif
    {{ $slot }}
@if ($url)
</div>
@else
</a>
@endif