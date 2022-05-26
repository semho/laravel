@extends('layout.master')

@section('title', 'Изменение новости')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Изменение новости
        </h3>

        @include('layout.errors')

        <form method="post" action="/tidings/{{ $tiding->slug }}">

            @method('PATCH')
            @csrf

            @include('tidings.fields')
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <form method="post" action="/tidings/{{ $tiding->slug }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endsection
