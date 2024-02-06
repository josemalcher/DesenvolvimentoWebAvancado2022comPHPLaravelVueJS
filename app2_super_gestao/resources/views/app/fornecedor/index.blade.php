<h3>FORNECEDOR</h3>

<p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
<p>Status: {{$fornecedores[0]['status']}}</p>

@isset($fornecedores)
    <p>Fornecedor: {{$fornecedores[1]['nome']}}</p>
    <p>Status: {{$fornecedores[1]['status']}}</p>

    @isset($fornecedores[1]['cnpj'])
        <p>CNPJ: {{$fornecedores[1]['cnpj']}}</p>
    @endisset

@endisset
