@component('mail::message')
    <h2>Рассылка статей</h2>
    <p>За период от {{ $from }} по {{ $to }}</p>
    <ul class="list-group">
        @foreach ($articles as $article)
            <li class="list-group-item"><a href="/articles/{{ $article->slug }}">{{ $article->name }}</a></li>
        @endforeach
    </ul>
@component('mail::button', ['url' => '/articles/' ])
    Посмотреть все статьи
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
