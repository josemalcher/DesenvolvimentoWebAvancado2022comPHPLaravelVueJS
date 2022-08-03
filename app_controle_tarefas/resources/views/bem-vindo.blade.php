Site da aplicação

@auth
    <h1>Usuário autenticado</h1>
    <p>{{ Auth::user()->id }}</p>
    <p>{{ Auth::user()->name }}</p>
    <p>{{ Auth::user()->email }}</p>
@endauth

@guest
    <p>Olá visitante, tudo ok?</p>
@endguest
