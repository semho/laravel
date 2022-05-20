@extends('layout.master')

@section('title', 'Отправка уведомления')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Отправить уведомление
        </h3>

        @include('layout.errors')
        @if(Session::has('info'))
            <div class="alert alert-success">
                {{Session::get('info')}}
            </div>
        @endif

        <form method="post" action="/service">

            @csrf

            <div class="form-group">
                <label for="inputName">Заголовок уведомления</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="inputName"
                    placeholder="Введите заголовок"
                    value="{{ old('name') }}"
                >
            </div>
            <div class="form-group">
                <label for="inputText">Текст уведомления</label>
                <textarea
                    type="text"
                    name="text"
                    class="form-control"
                    id="inputText"
                    rows="10">
                    {{ old('text') }}
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
