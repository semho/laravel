@extends('layout.master')

@section('title', 'Административный раздел')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Административный раздел
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

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 text-muted" href="/admin/articles">Управление статьями</a>
                <a class="p-2 text-muted" href="/admin/tidings">Управление новостями</a>
                <a class="p-2 text-muted" href="/admin/feedback">Список обращений</a>
            </nav>
        </div>

    </div><!-- /.blog-main -->

@endsection
