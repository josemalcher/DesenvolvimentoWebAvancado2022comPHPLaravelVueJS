<h3>FORNECEDOR</h3>

<p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
<p>Status: {{$fornecedores[0]['status']}}</p>

<p>(espapando)Fornecedor: @{{$fornecedor['nome']}}</p>

@isset($fornecedores)
    <p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
    <p>Status: {{$fornecedores[0]['status']}}</p>
    <p>CNPJ: {{$fornecedores[0]['cnpj'] ?? 'Dado não preenchido' }}</p>
    <!--
        $variavel testada não estiver definida (isset)
        ou
        $variavel testada não possuir o valor null
     -->
    <p>Telefones: {{$fornecedores[0]['ddd'] ?? ''}} {{$fornecedores[1]['telefone'] ?? ''}}</p>
    <p>
        @switch($fornecedores[0]['ddd'])
            @case('11')
                São Paulo - SP
                @break
            @case('32')
                Juis de Fora - MG
                @break
            @case('91')
                Belém - PA
                @break
            @default
                Estado não identificado
        @endswitch
    </p>
    <hr>
@endisset

@isset($fornecedores)
    @for($i = 0; isset($fornecedores[$i]); $i++)
        <p>Fornecedor: {{$fornecedores[$i]['nome']}}</p>
        <p>Status: {{$fornecedores[$i]['status']}}</p>
        <p>CNPJ: {{$fornecedores[$i]['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedores[$i]['ddd'] ?? ''}} {{$fornecedores[$i]['telefone'] ?? ''}}</p>
        <hr>
    @endfor
    <hr>
@endisset

@isset($fornecedores)
    @php $i = 0 @endphp
    @while(isset($fornecedores[$i]))
        <p>Fornecedor: {{$fornecedores[$i]['nome']}}</p>
        <p>Status: {{$fornecedores[$i]['status']}}</p>
        <p>CNPJ: {{$fornecedores[$i]['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedores[$i]['ddd'] ?? ''}} {{$fornecedores[$i]['telefone'] ?? ''}}</p>
        <hr>
        @php $i++ @endphp
    @endwhile
    <hr>
@endisset

@isset($fornecedores)
    @foreach($fornecedores as $indice => $fornecedor)
        <p>Fornecedor: {{$fornecedor['nome']}}</p>
        <p>Status: {{$fornecedor['status']}}</p>
        <p>CNPJ: {{$fornecedor['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedor['ddd'] ?? ''}} {{$fornecedor['telefone'] ?? ''}}</p>
        <hr>
    @endforeach
@endisset

@isset($fornecedores)
    @forelse($fornecedores as $indice => $fornecedor)
        <strong>Total de Interação {{$loop->count}}</strong>
        <br>
        <strong>Interação Atual: {{$loop->iteration}}</strong>

        <p>Fornecedor: {{$fornecedor['nome']}}</p>
        <p>Status: {{$fornecedor['status']}}</p>
        <p>CNPJ: {{$fornecedor['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedor['ddd'] ?? ''}} {{$fornecedor['telefone'] ?? ''}}</p>

        @if($loop->first)
            Primeira interação do LOOP
        @endif
        @if($loop->last)
            Ultima interação do loop
        @endif
        <hr>
    @empty
        <p>Não existe fornecedores Cadastrados!!!!</p>
    @endforelse
@endisset


