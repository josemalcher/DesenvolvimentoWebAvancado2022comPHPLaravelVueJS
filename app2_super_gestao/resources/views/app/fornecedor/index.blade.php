<h3>FORNECEDOR</h3>

<p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
<p>Status: {{$fornecedores[0]['status']}}</p>

@if(!($fornecedores[0]['status'] == 'S') )
    <p>Fornecedor Inativo</p>
@endif

@unless($fornecedores[0]['status'] == 'S') {{--Se o retorno da condição for false--}}
<p>Fornecedor Inativo UNLESS</p>
@endunless
