@component('mail::message')
# Статья удалена {{ $article->name }}

{{ $article->text }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
