@extends('layout.master')

@section('title', 'Статья')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $article->name }}
        </h3>
        <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
        {{ $article->text }}
        <hr>
        <a href="/">Вернуться к списку статей</a>
    </div>

@endsection
