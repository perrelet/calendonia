<main>
    @if ($args['ui'])
    <div class='ui'>
        @if ($args['ui_type'])
            <div class='filter'>
                <select id='type-filter' name='type' onchange="if (this.value) window.location.href=this.value">
                    <option value='{{ request()->fullUrlWithQuery(['type' => 0]) }}'>All Types</option>
                @foreach ($args['list_types'] as $type)
                    <option value='{{ request()->fullUrlWithQuery(['type' => str_replace(' ', '-', $type)]) }}'
                    @if ($type == $args['type'])
                    selected="selected"
                    @endif
                    >{{ ucwords($type) }}</option>
                @endforeach
                </select>
                <label for='type-filter' onclick="document.getElementById('type-filter').focus()">Filter</label>
            </div>
        @endif
        @if ($args['ui_tags'])
            <div class='filter'>
                <select name='tags' onchange="if (this.value) window.location.href=this.value">
                    <option value='{{ request()->fullUrlWithQuery(['tags' => 0]) }}'>All Tags</option>
                @foreach ($args['list_tags'] as $tag)
                    <option value='{{ request()->fullUrlWithQuery(['tags' => $tag->slug]) }}'
                    @if ($tag->slug == app('request')->input('tags'))
                    selected="selected"
                    @endif
                    >{{ ucwords($tag->name) }}</option>
                @endforeach
                </select>
                <label for='tags'>Tag:</label>
            </div>
        @endif
    </div>
    @endif
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
</main>