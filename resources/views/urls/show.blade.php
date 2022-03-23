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
        </div>
    </main>
@endsection
