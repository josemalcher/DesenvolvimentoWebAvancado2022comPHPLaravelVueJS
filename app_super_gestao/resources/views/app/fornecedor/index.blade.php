<h3>FORNECEDOR</h3>

{{-- COMENTARIOS.... --}}

{{ 'Texto de teste' }}

<?= 'Testo de teste igual ao de cima'?>

@php
    // comentario vário
    echo 'Texto dentro do PHP
    '
@endphp

@isset($fornecedores)
    <p>Fornecedor: {{$fornecedores[1]['nome']}}</p>
    <p>Status: {{$fornecedores[1]['status']}}</p>
    <p>CNPJ: {{$fornecedores[1]['cnpj'] ?? 'Dado não preenchido' }}</p>
<!--
    $variavel testada não estiver definida (isset)
    ou
    $variavel testada não possuir o valor null
 -->

@endisset

@dd($fornecedores)
