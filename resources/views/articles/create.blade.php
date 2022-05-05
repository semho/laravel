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

            <div class="form-group">
                <label for="inputName">Название статьи</label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Введите название статьи" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="inputSlug">Символьное название статьи</label>
                <input type="text" name="slug" class="form-control" id="inputSlug" value="{{ old('slug') }}">
            </div>
            <div class="form-group">
                <label for="inputDesc">Краткое описание</label>
                <input type="text" name="desc" class="form-control" id="inputDesc" placeholder="Введите краткое описание" value="{{ old('desc') }}">
            </div>
            <div class="form-group">
                <label for="inputText">Текст статьи</label>
                <textarea type="text" name="text" class="form-control" id="inputText" rows="10">{{ old('text') }}</textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="publishedCheckbox" name="published">
                <label class="form-check-label" for="publishedCheckbox">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
