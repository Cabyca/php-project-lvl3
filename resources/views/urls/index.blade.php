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
                    @foreach ($lastCheckSites as $lastCheckSite)
                    <tr>
                        <td>{{ $lastCheckSite->id }}</td>
                        <td><a href="{{ route('urls.show', $lastCheckSite->id) }}">{{ $lastCheckSite->name }}</a></td>
                        <td>{{ $lastCheckSite->created_at }}</td>
                        <td>{{ $lastCheckSite->status_code }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lastCheckSites->links() }}
        </div>
    </div>
</main>
@endsection
