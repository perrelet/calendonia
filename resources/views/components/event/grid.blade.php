<div>
    <x-event.part.wrap :url="$event->url">
        {{ $event['title'] }} | {{ $event['tags']->implode('name', ', ') }} | {{ $event->get_start_date() }}
    </x-event.part.wrap>
</div>