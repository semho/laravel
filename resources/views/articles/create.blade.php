@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/articles">

            @csrf

            @include('layout.fields')
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
