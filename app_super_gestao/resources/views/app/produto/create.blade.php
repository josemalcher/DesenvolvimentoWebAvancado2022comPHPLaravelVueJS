@extends('app.layouts.basico')

@section('titulo', 'Produto - Adicionar')

@section('conteudo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Produto - Adicioniar</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="#">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            {{ $msg ?? '' }}
            <div style="width: 30%; margin-left: auto; margin-right: auto;" >
                <form action="" method="post">
                    @csrf

                    <input value="" type="text" name="nome" placeholder="Nome" class="borda-preta">

                    <input value="" type="text" name="descricao" placeholder="Descrição" class="borda-preta">

                    <input value="" type="text" name="peso" placeholder="Peso" class="borda-preta">

                    <select name="unidade_id" id="unidade_id">
                        <option> -- SELECIONE a UNIDADE de MEDIDA</option>

                        @foreach($unidades as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->descricao }}</option>
                        @endforeach

                    </select>

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
