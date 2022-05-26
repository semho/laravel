@extends('layout.master')

@section('title', 'Список обращений')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Список обращений
        </h3>

        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Email</th>
                <th>Сообщение</th>
                <th>Дата получения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <th scope="row">{{ $notification->id }}</th>
                    <td>{{ $notification->email }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $notifications->links() }}
    </div>

@endsection
