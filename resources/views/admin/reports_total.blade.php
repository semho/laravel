@extends('layout.master')

@section('title', 'Итого')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Итого
        </h3>
        <p>
            Выберите пункты, на которые требуется сформировать отчет
        </p>
        @if (Session::has('status'))
            <div class="alert alert-danger">
                {{ Session::get('status') }}
            </div>
        @endif
        <form action="/admin/reports_total" method="post" class="mb-3">
            @csrf
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex align-items-center custom-control custom-checkbox pl-5">
                    <input type="checkbox" class="custom-control-input" id="news" name="news">
                    <label class="custom-control-label" for="news">Новости</label>
                </li>
                <li class="list-group-item d-flex align-items-center custom-control custom-checkbox pl-5">
                    <input type="checkbox" class="custom-control-input" id="articles" name="articles">
                    <label class="custom-control-label" for="articles">Статьи</label>
                </li>
                <li class="list-group-item d-flex align-items-center custom-control custom-checkbox pl-5">
                    <input type="checkbox" class="custom-control-input" id="comments" name="comments">
                    <label class="custom-control-label" for="comments">Комментарии</label>
                </li>
                <li class="list-group-item d-flex align-items-center custom-control custom-checkbox pl-5">
                    <input type="checkbox" class="custom-control-input" id="tags" name="tags">
                    <label class="custom-control-label" for="tags">Теги</label>
                </li>
                <li class="list-group-item d-flex align-items-center custom-control custom-checkbox pl-5">
                    <input type="checkbox" class="custom-control-input" id="users" name="users">
                    <label class="custom-control-label" for="users">Пользователи</label>
                </li>
            </ul>
            <button type="submit" class="btn btn-primary">Сгенерировать отчёт</button>
        </form>

    </div>

@endsection
