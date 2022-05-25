
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>

<div class="container">

    @include('layout.nav')

    <main role="main" class="container">
        <div class="row">
            @yield('content')

            @if(request()->is('/'))
                @include('layout.sidebar')
            @elseif(request()->is('articles'))
                @include('layout.sidebar')
            @elseif(request()->is('articles/*'))
                @include('layout.sidebar')
            @endif

        </div>
    </main>

    @include('layout.footer')

</body>
</html>
