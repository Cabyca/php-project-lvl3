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
            {{ $urls->links() }}
        </div>
    </div>
</main>
@endsection
@section('navbar')
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('urls.index') }}">Сайты</a>
            </li>
        </ul>
    </div>
@endsection
