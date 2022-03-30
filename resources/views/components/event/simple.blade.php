<x-event.part.wrap {{ $attributes->merge(['class' => 'event']) }} :url="$event->url" tag="article">
    <div class="thumb" style="background-image: url({{ $event->thumb }});"></div>
    <div class="paper-date">
        <div data-period="D">{{ $event->get_start_date("D") }}</div>
        <div data-period="j">{{ $event->get_start_date("j") }}</div>
        <div data-period="M">{{ $event->get_start_date("M") }}</div>
    </div>
    <div class="info">
        <div class="title">{{ $event['title'] }}</div>
        <div class="time">{{ $event->get_start_date("h:i a") }} <span class='timezone'>{{ $event->get_start_date("T") }}</span></div>
        <div class="type" data-type="{{ str($event['type'])->slug() }}">{{ $event['type'] }}</div>
        {{--<div class="tags">
        @foreach ($event->tags as $tag)
            <div>{{ $tag->translate('name') }}</div>
        @endforeach
        </div>--}}
    </div>
</x-event.part.wrap>
