@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Data limite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{ $tarefa->id }}</th>
                                    <td>{{ $tarefa->descricao }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>

                            @foreach (range(1, $tarefas->lastPage()) as $page)
                                <li class="page-item {{ $tarefas->currentPage() == $page ? 'active' : '' }}"><a class="page-link" href="{{ $tarefas->url($page) }}">{{ $page }}</a></li>
                            @endforeach

                            <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Próxima</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
