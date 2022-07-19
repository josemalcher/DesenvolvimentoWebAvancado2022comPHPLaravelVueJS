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
                <form action="{{ route('produto.store') }}" method="post">
                    @csrf
                    <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="descricao" value="{{ old('descricao') }}" placeholder="Descrição" class="borda-preta">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                    <input type="text" name="peso" value="{{ old('peso') }}" placeholder="peso" class="borda-preta">
                    {{ $errors->has('peso') ? $errors->first('peso') : '' }}

                    <select name="unidade_id">
                        <option>-- Selecione a Unidade de Medida --</option>

                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }} {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}">{{ $unidade->descricao }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
