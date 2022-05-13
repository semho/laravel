@component('mail::message')
# Создана новая статья {{ $article->name }}

{{ $article->text }}

@component('mail::button', ['url' => '/articles/' . $article->slug ])
Посмотреть статью
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
