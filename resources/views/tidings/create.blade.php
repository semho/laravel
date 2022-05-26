@extends('layout.master')

@section('title', 'Создать новость')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание новости
        </h3>

        @include('layout.errors')

        <form method="post" action="/tidings">

            @csrf

            @include('tidings.fields')
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
