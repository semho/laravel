@component('mail::message')
# Статья изменена {{ $article->name }}

{{ $article->text }}

@component('mail::button', ['url' => '/articles/' . $article->slug ])
Посмотреть статью
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
