@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tarefas
                    <a class="btn btn-success btn-sm float-right" href="{{ route('tarefa.create') }}">Nova</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Data limite</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{ $tarefa->id }}</th>
                                    <td>{{ $tarefa->descricao }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</td>
                                    <td>
                                        <a 
                                            href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id]) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Editar
                                        </a>
                                        <a
                                            href="#"
                                            class="btn btn-danger btn-sm"
                                            onclick="document.getElementById('form_destoy_tarefa_{{ $tarefa->id }}').submit()"
                                        >
                                            Excluir
                                        </a>
                                        <form
                                            method="post"
                                            id="form_destoy_tarefa_{{ $tarefa->id }}"
                                            action="{{ route('tarefa.destroy', ['tarefa'=> $tarefa->id]) }}"
                                        >
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
