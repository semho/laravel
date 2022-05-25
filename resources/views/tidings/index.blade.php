@extends('layout.master')

@section('title', 'Новости')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список новостей
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

        @foreach($tidings as $tiding)
            @include('tidings.item')
        @endforeach

        {{ $tidings->links() }}

    </div><!-- /.blog-main -->

@endsection
