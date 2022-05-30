@component('mail::message')
# Отчет сформирован:

<ul class="list-group">
    @foreach ($data as $item)
        <li class="list-group-item"> {{ $item }}</li>
    @endforeach
</ul>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
