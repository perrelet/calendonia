<div>
    <x-event.part.wrap :url="$event->url">
        {{ $event['title'] }}
        {{ $event->get_start_date() }}
    </x-event.part.wrap>
</div>