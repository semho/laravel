@extends('layout.master')

@section('title', 'Статья')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $article->name }}
            @can('update', $article)
                <a href="/articles/{{ $article->slug }}/edit">Редактировать</a>
            @endcan
            @auth
                @if(\App\Models\Role::isAdmin(Auth::user()))
                    <a href="/admin">В Админ.раздел</a>
                @endif
            @endauth
        </h3>

        @include('articles.tags', ['tags' => $article->tags])

        <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
        {{ $article->text }}
        <hr>
        <a href="/">Вернуться к списку статей</a>
    </div>

@endsection
