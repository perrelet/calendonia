<ul {{ $attributes }}>
    @foreach ($tags as $tag)
    <li>{{ $tag }}</li>
    @endforeach
</ul>