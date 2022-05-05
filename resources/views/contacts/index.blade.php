@extends('layout.master')

@section('title', 'Контакты')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Контакты
        </h3>

        @include('layout.errors')

        <form method="post" action="/contacts">

            @csrf

            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Введите Ваш Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="inputMessage">Сообщение</label>
                <textarea type="text" name="message" class="form-control" id="inputMessage" rows="10">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection
