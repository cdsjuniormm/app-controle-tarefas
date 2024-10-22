@component('mail::message')
# Tarefa
{{ $tarefa->descricao }}

Data limite: {{ date('d/m/Y', strtotime($tarefa->data_limite)) }}

@component('mail::button', ['url' => $url])
Ver tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
