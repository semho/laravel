@extends('layout.master')

@section('title', 'Новость')

@section('content')
    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $tiding->name }}
            @can('update', $tiding)
                <a href="/tidings/{{ $tiding->slug }}/edit">Редактировать</a>
            @endcan
            @auth
                @if(\App\Models\Role::isAdmin(Auth::user()))
                    <a href="/admin">В Админ.раздел</a>
                @endif
            @endauth
        </h3>

        <p class="blog-post-meta">{{ $tiding->created_at->toFormattedDateString() }}</p>
        {{ $tiding->text }}
        <hr>
        <a class = "blog-link-back" href="/tidings/">Вернуться к списку новостей</a>
    </div>

@endsection
