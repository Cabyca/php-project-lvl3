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
            <!--<form method="post" action="https://php-l3-page-analyzer.herokuapp.com/urls/1/checks">
                <input type="hidden" name="_token" value="V1c9yS0qkLWLe8vGMMh7Z8uM6B2PxoFIuJfow5vb">
                <input type="submit" class="btn btn-primary" value="Запустить проверку">
            </form>-->

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

                <tr>
                    <td>79</td>
                    <td>200</td>
                    <td>(function...</td>
                    <td>Mail.ru: почта, поиск в интерн...</td>
                    <td>Почта Mail.ru — крупнейшая бес...</td>
                    <td>2022-02-06 14:50:39</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
