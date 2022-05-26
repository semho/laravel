@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="/tidings/tags/{{ $tag->getRouteKey() }}" class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
