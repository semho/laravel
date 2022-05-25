@extends('layout.master')

@section('title', 'Главная страница')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список статей
        </h3>
        @if(Session::has('info'))
            <div class="alert alert-success">
                {{Session::get('info')}}
            </div>
        @endif
        @if (Session::has('status'))
            <div class="alert alert-danger">
                {{ Session::get('status') }}
            </div>
        @endif

        @foreach($articles as $article)
            @include('articles.item')
        @endforeach

        {{ $articles->links() }}

    </div><!-- /.blog-main -->

@endsection
