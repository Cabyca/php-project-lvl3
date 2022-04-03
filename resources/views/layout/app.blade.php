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
        @yield('navbar')
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
