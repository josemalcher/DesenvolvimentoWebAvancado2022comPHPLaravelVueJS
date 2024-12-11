{{$slot}}

<form action="{{route('site.contato')}}" method="post">
    @csrf
    <input type="text" placeholder="Nome" class="{{ $classe }}" name="nome">
    <br>
    <input type="text" placeholder="Telefone" class="{{ $classe }}" name="telefone">
    <br>
    <input type="text" placeholder="E-mail" class="{{ $classe }}" name="email">
    <br>
    <select class="{{ $classe }}" name="motivo_contato">
        <option value="">Qual o motivo do contato?</option>
        <option value="">Dúvida</option>
        <option value="">Elogio</option>
        <option value="">Reclamação</option>
    </select>
    <br>
    <textarea name="mensagem" class="{{ $classe }}"></textarea>
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>
