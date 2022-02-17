<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    {!! $event['tag_open'] !!} class="">
    {{ $event['title'] }}
    {{ $event->get_start_date() }}
    {!! $event['tag_close'] !!}
</div>