@component('mail::message')
# {{ $tarefa }}

Data Limite de conclusão: {{ $data_limite_conclusao }}

@component('mail::button', ['url' => $url])
Click aqui para ver a tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
