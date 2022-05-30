@extends('layout.master')

@section('title', 'Отчеты')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Отчеты
        </h3>
        @if(Session::has('info'))
            <div class="alert alert-success">
                {{Session::get('info')}}
            </div>
        @endif
        <a href="/admin/reports_total" class="btn btn-primary">Итого</a>

    </div>

@endsection
