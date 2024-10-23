@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefa</div>

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <input type="text" class="form-control" value="{{ $tarefa->descricao }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="data_limite" class="form-label">Data limite</label>
                        <input type="date" class="form-control" value="{{ $tarefa->data_limite }}" disabled>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
