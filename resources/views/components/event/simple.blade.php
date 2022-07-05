<x-event.part.wrap {{ $attributes->merge(['class' => 'item event']) }} :url="$event->url" tag="article">
    <div class="card">
        <div class="thumb" style="background-image: url({{ $event->get_thumb() }});"></div>
        <div class="date">
            <div data-period="D">{{ $event->get_start_date("D") }}</div>
            <div data-period="j">{{ $event->get_start_date("jS") }}</div>
            <div data-period="M">{{ $event->get_start_date("M") }}</div>
        </div>
    </div>
    <div class="info">
        <div class="title">{{ $event['title'] }}</div>
        <div class="when-where">
            {{ $event->get_start_date("h:i a") }} <span class='timezone'>{{ $event->get_start_date("T") }}</span>
            |
            {{ $event->get_location() }}
        </div>
        <div class='atts'>
            @if ($event->virtual)
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" > <path fill-rule="evenodd" clip-rule="evenodd" d="M11 17H4C2.34315 17 1 15.6569 1 14V6C1 4.34315 2.34315 3 4 3H20C21.6569 3 23 4.34315 23 6V14C23 15.6569 21.6569 17 20 17H13V19H16C16.5523 19 17 19.4477 17 20C17 20.5523 16.5523 21 16 21H8C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19H11V17ZM4 5H20C20.5523 5 21 5.44772 21 6V14C21 14.5523 20.5523 15 20 15H4C3.44772 15 3 14.5523 3 14V6C3 5.44772 3.44772 5 4 5Z" fill="currentColor" /> </svg>
            @else
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" > <path d="M10 12C10 12.5523 9.55228 13 9 13C8.44772 13 8 12.5523 8 12C8 11.4477 8.44772 11 9 11C9.55228 11 10 11.4477 10 12Z" fill="currentColor" /> <path d="M15 13C15.5523 13 16 12.5523 16 12C16 11.4477 15.5523 11 15 11C14.4477 11 14 11.4477 14 12C14 12.5523 14.4477 13 15 13Z" fill="currentColor" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0244 2.00003L12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.74235 17.9425 2.43237 12.788 2.03059L12.7886 2.0282C12.5329 2.00891 12.278 1.99961 12.0244 2.00003ZM12 20C16.4183 20 20 16.4183 20 12C20 11.3014 19.9105 10.6237 19.7422 9.97775C16.1597 10.2313 12.7359 8.52461 10.7605 5.60246C9.31322 7.07886 7.2982 7.99666 5.06879 8.00253C4.38902 9.17866 4 10.5439 4 12C4 16.4183 7.58172 20 12 20ZM11.9785 4.00003L12.0236 4.00003L12 4L11.9785 4.00003Z" fill="currentColor" /> </svg>
            @endif
            <div class="type" data-type="{{ str($event['type'])->slug() }}">
                {{ $event['type'] }}
            </div>
        </div>
        {{--<div class="tags">
        @foreach ($event->tags as $tag)
            <div>{{ $tag->translate('name') }}</div>
        @endforeach
        </div>--}}
    </div>
</x-event.part.wrap>
