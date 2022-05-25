@extends('layout.master')

@section('title', 'Управление статьями')

@section('content')
    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Управление статьями
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
            @foreach($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td><a href="/articles/{{ $article->slug }}/edit">{{ $article->name }}</a></td>
                    <td>{{ $article->created_at->toFormattedDateString() }}</td>
                    <td>{{ $article->is_published ? 'да' : 'нет' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $articles->links() }}
    </div>

@endsection
