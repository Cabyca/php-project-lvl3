app.blade.php

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Анализатор страниц</title>

    <!-- Scripts -->
    <script src="https://php-page-analyzer-ru.hexlet.app/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://php-page-analyzer-ru.hexlet.app/css/app.css" rel="stylesheet">
</head>
<body class="min-vh-100 d-flex flex-column">
<header class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="/">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('urls.index') }}">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@include('flash::message')
<div class="flex-shrink-0">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <h5 class="alert alert-danger" role="alert" class="flex-shrink-0">{{ $error }}</h5>
    @endforeach
    @endif
</div>
@yield('content')
<footer class="border-top py-3 mt-5 flex-shrink-0">
    <div class="container-lg">
        <div class="text-center">
            <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
        </div>
    </div>
</footer>
</body>
</html>

index.blade.php

@extends('layout.app')
@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td><a href="{{ route('urls.show', $url->id) }}">{{ $url->name }}</a></td>
                    @php
                    /** @var object $url */
                    $urlCheck = $urlsChecks[$url->id] ?? null
                    @endphp
                    <td>{{ $urlCheck ? $urlCheck->created_at : ''}}</td>
                    <td>{{ $urlCheck ? $urlCheck->status_code : ''}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

show.blade.php

@extends('layout.app')
@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody><tr>
                    <td>ID</td>
                    <td>{{ $url->id }}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{ $url->name }}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{ $url->created_at }}</td>
                </tr>
                </tbody></table>
        </div>
        <h2 class="mt-5 mb-3">Проверки</h2>
        <form action="{{ route('checks.store', $url->id) }}" method="post" class="d-flex justify-content-left">
            @csrf
            <input type="submit" class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" value="Проверить">
        </form>
        <table class="table table-bordered table-hover text-nowrap">
            <tbody>
            <tr>
                <th>ID</th>
                <th>Код ответа</th>
                <th>h1</th>
                <th>title</th>
                <th>description</th>
                <th>Дата создания</th>
            </tr>
            @foreach ($checksSite as $checkSite)
            <tr>
                <td>{{ $checkSite->id }}</td>
                <td>{{ $checkSite->status_code }}</td>
                <td>{{ str_limit($checkSite->h1, $limit = 10) }}</td>
                <td>{{ str_limit($checkSite->title, $limit = 30) }}</td>
                <td>{{ str_limit($checkSite->description, $limit = 30) }}</td>
                <td>{{ $checkSite->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $checksSite->links() }}
    </div>
</main>
@endsection
