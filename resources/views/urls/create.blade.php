app.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
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
                    <a class="nav-link " href="{{ route('urls.index') }}">Сайты</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="flex-grow-1">
    @include('flash::message')
    <div class="flex-shrink-0">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <h5 class="alert alert-danger" role="alert" class="flex-shrink-0">{{ $error }}</h5>
            @endforeach
        @endif
    </div>
    @yield('content')
</main>
<footer class="border-top py-3 mt-5 flex-shrink-0">
    <div class="container-lg">
        <div class="text-center">
            <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
        </div>
    </div>
</footer>
</body>
</html>

welcome.blade.php

<input type="hidden" name="_token" value="zSCb0MELmLXitVT44AkexysgbezyvliTaub5SyH">

@extends('layout.app')
@section('content')
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">Анализатор страниц</h1>
                <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
                <form action="{{ route('urls.store') }}" method="post" class="d-flex justify-content-center">
                    @csrf
                    <input type="hidden" name="_token" value="zSCb0MELmLXitVT44AkexysgbezyvliTcaub5SyH">
                    <input type="text" name="url[name]" value="" class="form-control form-control-lg" placeholder="https://www.example.com">
                    <input type="submit" class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" value="Проверить">
                </form>
            </div>
        </div>
    </div>
@endsection('content')
