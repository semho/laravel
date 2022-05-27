@extends('layout.master')

@section('title', 'Административный раздел')

@section('content')

    <div class="col-md-12 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Статистика
        </h3>

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Общее количество статей
                <span class="badge badge-primary badge-pill">{{ $countArticles }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Общее количество новостей
                <span class="badge badge-primary badge-pill">{{ $countTidings }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                ФИО автора, у которого больше всего статей на сайте
                <span class="badge badge-pill">{{ $userWithMaxValueArticles->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Самая длинная статья — название, ссылка на статью и длина статьи в символах.
                <a href="/articles/{{ $articleWithMaxLongName->slug }}">{{ $articleWithMaxLongName->name }}</a>
                <span class="badge badge-primary badge-pill">{{ $articleWithMaxLongName->max }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Самая короткая статья — название, ссылка на статью и длина статьи в символах.
                <a href="/articles/{{ $articleWithMinLongName->slug }}">{{ $articleWithMinLongName->name }}</a>
                <span class="badge badge-primary badge-pill">{{ $articleWithMinLongName->max }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Средние количество статей у активных пользователей (пользователь считается активным, если у него более 1 статьи).
                <span class="badge badge-primary badge-pill">{{ $avgCountArticles }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Самая непостоянная — название, ссылка на статью, которую меняли больше всего раз.

                @if($mostUpdateArticle)
                    <a href="/articles/{{ $mostUpdateArticle->slug }}">{{ $mostUpdateArticle->name }}</a>
                @else
                        <span class="badge badge-pill">Статьи еще не обновляли</span>
                @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Самая обсуждаемая статья — название, ссылка на статью, у которой больше всего комментариев.

                @if($mostDiscussedArticle)
                    <a href="/articles/{{ $mostDiscussedArticle->slug }}">{{ $mostDiscussedArticle->name }}</a>
                @else
                    <span class="badge badge-pill">Комментарий еще нет</span>
                @endif
            </li>
        </ul>

    </div><!-- /.blog-main -->

@endsection
