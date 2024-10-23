@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarefa</div>

                <div class="card-body">
                    <form action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input
                                type="text" 
                                class="form-control" 
                                id="descricao" 
                                name="descricao" 
                                placeholder="Descrição"
                                value="{{ old('descricao') ?? $tarefa->descricao }}"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="data_limite" class="form-label">Data limite</label>
                            <input
                                type="date"
                                class="form-control"
                                id="data_limite"
                                name="data_limite"
                                value="{{ old('data_limite') ?? $tarefa->data_limite }}"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
