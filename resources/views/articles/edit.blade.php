@extends('layout.master')

@section('title', 'Изменение статьи')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Изменение статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/articles/{{ $article->slug }}">

            @method('PATCH')
            @csrf

            @include('layout.fields')
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <form method="post" action="/articles/{{ $article->slug }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endsection
