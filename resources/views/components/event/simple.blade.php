<x-event.part.wrap :url="$event->url" tag="article">
    <div class="paper-date">
        <div data-period="D">{{ $event->get_start_date("D") }}</div>
        <div data-period="j">{{ $event->get_start_date("j") }}</div>
        <div data-period="M">{{ $event->get_start_date("M") }}</div>
    </div>
    <div>
        {{ $event['title'] }}
        {{ $event->get_start_date() }}
    </div>
</x-event.part.wrap>
