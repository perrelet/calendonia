<div {{ $attributes->merge(['class' => 'events']) }}>
@foreach ($events as $event)
    <x-dynamic-component {{ $attributes }} :component="$component" :event="$event"/>
@endforeach
</div>