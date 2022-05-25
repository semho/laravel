@extends('layout.master')

@section('title', 'Управление новостями')

@section('content')
    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Управление новостями
        </h3>

        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Дата создания</th>
                <th>Опубликованно</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tidings as $tiding)
                <tr>
                    <th scope="row">{{ $tiding->id }}</th>
                    <td><a href="/tidings/{{ $tiding->slug }}/edit">{{ $tiding->name }}</a></td>
                    <td>{{ $tiding->created_at->toFormattedDateString() }}</td>
                    <td>{{ $tiding->is_published ? 'да' : 'нет' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>

@endsection
