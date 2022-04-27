<div {{ $attributes->merge(['class' => 'events']) }}>
@if ($grouped)
   @foreach ($grouped as $key => $group)
    <div class='item divider'>{{ $key }}</div>
    @foreach ($group as $event)
        <x-dynamic-component {{ $attributes }} :component="$component" :event="$event"/>
    @endforeach
    @endforeach
@else
    @foreach ($events as $event)
        <x-dynamic-component {{ $attributes }} :component="$component" :event="$event"/>
    @endforeach
@endif
</div>
@if ($events instanceof \Illuminate\Pagination\LengthAwarePaginator)
{{ $events->withQueryString()->links() }}
@endif
