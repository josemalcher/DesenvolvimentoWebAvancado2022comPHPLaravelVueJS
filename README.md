# Desenvolvimento Web Avançado 2022 com PHP, Laravel e Vue.JS

https://www.udemy.com/course/curso-completo-do-desenvolvedor-laravel/

## <a name="indice">Índice</a>

1. [Introdução](#parte1)     
2. [[WINDOWS] - Preparando-se para o desenvolvimento](#parte2)     
3. [[LINUX] - Preparando-se para o desenvolvimento](#parte3)     
4. [[OSX] - Preparando-se para o desenvolvimento](#parte4)     
5. [Introdução as Rotas, Controllers e Views](#parte5)     
6. [Avançando com Rotas (Routes)](#parte6)     
7. [Avançando com Controladores (Controllers) e Visualizações (Views)](#parte7)     
8. [Models, Migrations, Seeders, Factories, Banco de Dados, Tinker e Eloquent ORM](#parte8)     
9. [Trabalhando com formulários](#parte9)     
10. [Middlewares](#parte10)     
11. [Autenticação de usuários (revisando e praticando os assuntos abordados)](#parte11)     
12. [Finalizando o projeto Super Gestão](#parte12)     
13. [Autenticação WEB (Session) e Bootstrap (CSS)](#parte13)     
14. [Implementando o envio de e-mails e a exportação de arquivos XLSX, CSV e PDF](#parte14)     
15. [Adaptação para o próximo nível no domínio do Framework Laravel](#parte15)     
16. [Vue.JS para iniciantes](#parte16)     
17. [APIs, WebServices e Rest](#parte17)     
18. [Autenticação API - Autorização JWT (JSON Web Token)](#parte18)     
19. [Aplicação Full Stack Back-end API Laravel com Front-end Vue.JS](#parte19)     
20. [Armazenamento em memória com Redis (Laravel Cache)](#parte20)     
---


## <a name="parte1">1 - Introdução</a>



[Voltar ao Índice](#indice)

---


## <a name="parte2">2 - [WINDOWS] - Preparando-se para o desenvolvimento</a>

7. Iniciando um projeto Laravel (Via Composer)

```
$ composer config -g repo.packagists composer https://packagist.org

$ composer config -g github-protocols https ssh

$ composer global require laravel/installer
```

[Voltar ao Índice](#indice)

---


## <a name="parte3">3 - [LINUX] - Preparando-se para o desenvolvimento</a>



[Voltar ao Índice](#indice)

---


## <a name="parte4">4 - [OSX] - Preparando-se para o desenvolvimento</a>



[Voltar ao Índice](#indice)

---


## <a name="parte5">5 - Introdução as Rotas, Controllers e Views</a>

- 23 Iniciando o projeto

```
 composer create-project --prefer-dist laravel/laravel:^7.0 app_super_gestao

```

- 24 Produtividade com Artisan Console
- 25 Rotas (Routes) - Introdução
- 26 Super Gestão - Implementando as rotas principal, sobre-nos e contato
- 27 Controladores (Controllers) - Introdução
- 28 Super Gestão - Implementando os controladores principal, sobre-nos e contato
- 29 Visualizações (Views) - Introdução
- 30 Super Gestão - Implementando as visualizações principal, sobre-nos e contato

[Voltar ao Índice](#indice)

---


## <a name="parte6">6 - Avançando com Rotas (Routes)</a>

- 31 Enviando parâmetros
- 32 Parâmetros opcionais e valores padrões
- 33 Tratando parâmetros de rotas com expressões regulares

```php
Route::get(
    '/contato/{nome}/{categoria_id}',
    function (
        string $nome = 'Desconhecido',
        int    $categoria_id = 1 // 1- 'informação'
    ) {
        echo "Nome: " . $nome . ' Categoria = ' . $categoria_id;
    })
        ->where('categoria_id', '[0-9+]')
        ->where('nome', '[A-Za-z]+');

```

- 34 Super Gestão - Criando o menu de navegação

```
$ php artisan route:list
+--------+----------+-------------------------------+------+----------------------------------------------------+------------+
| Domain | Method   | URI                           | Name | Action                                             | Middleware |
+--------+----------+-------------------------------+------+----------------------------------------------------+------------+
|        | GET|HEAD | /                             |      | App\Http\Controllers\PrincipalController@principal | web        |
|        | GET|HEAD | api/user                      |      | Closure                                            | api        |
|        |          |                               |      |                                                    | auth:api   |
|        | GET|HEAD | contato                       |      | App\Http\Controllers\ContatoController@contato     | web        |
|        | GET|HEAD | contato/{nome}/{categoria_id} |      | Closure                                            | web        |
|        | GET|HEAD | sobre-nos                     |      | App\Http\Controllers\SobrenosController@sobrenos   | web        |
+--------+----------+-------------------------------+------+----------------------------------------------------+------------+


```

- 35 Super Gestão - Implementando as rotas login, clientes, fornecedores e produtos
- 36 Agrupando rotas

```php
Route::prefix('/app')->group(function () {
    Route::get('/clientes', function (){return 'Clientes';});
    Route::get('/fornecedores',  function (){return 'Fornecedores';});
    Route::get('/produtos',  function (){return 'Produtos';});

});
```

- 37 Nomeando rotas

```php
Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/sobre-nos', 'SobrenosController@sobrenos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');

Route::get('/login', 'ContatoController@contato')->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function (){return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores',  function (){return 'Fornecedores';})->name('app.fornecedores');
    Route::get('/produtos',  function (){return 'Produtos';})->name('app.produtos');
});
```

```php
<ul>
    <li>
        <a href="{{route('site.index')}}">Principal</a>
    </li>
    <li>
        <a href="{{route('site.sobrenos')}}">Sobre Nós</a>
    </li>
    <li>
        <a href="{{route('site.contato')}}">Contato</a>
    </li>
</ul>

```

- 38 Redirecionamento de rotas

```php
Route::get('/rota1', function (){
    echo 'ROTA 1';
})->name('site.rota1');

//Route::get('/rota2', function (){
//    echo 'ROTA 2;
//})->name('site.rota2');
Route::redirect('/rota2', '/rota1');
```

```php
Route::get('/rota1', function (){
    echo 'ROTA 1';
})->name('site.rota1');

Route::get('/rota2', function (){
    return redirect()->route('site.rota1');
})->name('site.rota2');
```

- 39 Rota de contingência (fallback)

```
Route::fallback(function () {
    echo 'A Rota não existe - <a href="'. route('site.index') .'">Voltar</a>';
});

```


[Voltar ao Índice](#indice)

---


## <a name="parte7">7 - Avançando com Controladores (Controllers) e Visualizações (Views)</a>

- 40 Encaminhando parâmetros da rota para o controlador

```php
Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');
```

```php
class TesteController extends Controller
{
    public function teste(int $p1,int  $p2)
    {
        echo "A Soma de $p1 + $p2 é: " . ($p1 + $p2);
    }
}
```

- 41 Encaminhando parâmetros do controlador para visualização

```php
class TesteController extends Controller
{
    public function teste(int $p1, int $p2)
    {
        // return view('site.teste', ['x'=>$p1, 'y' => $p2]);
        // return view('site.teste', compact('p1', 'p2'));
        return view('site.teste')
            ->with('p1', $p1)
            ->with('p2', $p2);
    }
}
```

```php
<p>Calculo</p>
<p>P1 = {{$p1}}</p>
<p>P2 = {{$p2}}</p>
<p>SOMA = {{$p1 + $p2}}</p>
```


- 42 Sintaxe Blade
- 43 Blade - Incluíndo comentários e blocos PHP puros

```php

<h3>FORNECEDOR</h3>

{{-- COMENTARIOS.... --}}

{{ 'Texto de teste' }}

<?= 'Testo de teste igual ao de cima'?>

@php
    // comentario vário
    echo 'Texto dentro do PHP
    '
@endphp

``` 

- 44 Extra - Adicionando a extensão VSCode Laravel-Blade
- 45 Blade - @if/@else

```php
@if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existe alguns fornecedores cadastrados</h3>
@elseif(count($fornecedores)> 10)
    <h3>Existem varios fornecedores cadastrados</h3>
@else
    <h3>Nenhum fornecedor Cadastrados</h3>
@endif
``` 
 
- 46 Blade - @unless

```php
<p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
<p>Status: {{$fornecedores[0]['status']}}</p>

@if(!($fornecedores[0]['status'] == 'S') )
    <p>Fornecedor Inativo</p>
@endif
@unless($fornecedores[0]['status'] == 'S') {{--Se o retorno da condição for false--}}
    <p>Fornecedor Inativo UNLESS</p>
@endunless

```

- 47 Blade - @isset

```php
class FornecedorController extends Controller
{
    public function index()
    {
        //$fornecedores = ['Fornecedor 1'];
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '00.000.000/000-00'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'N'
            ]
        ];
        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
```

```php
@isset($fornecedores)
<p>Fornecedor: {{$fornecedores[1]['nome']}}</p>
<p>Status: {{$fornecedores[1]['status']}}</p>

@isset($fornecedores[1]['cnpj'])
    <p>CNPJ: {{$fornecedores[1]['cnpj']}}</p>
@endisset

@endisset

```


- 48 Blade - @empty

```php
@isset($fornecedores)
<p>Fornecedor: {{$fornecedores[0]['nome']}}</p>
<p>Status: {{$fornecedores[0]['status']}}</p>

@isset($fornecedores[0]['cnpj'])
    CNPJ: {{$fornecedores[0]['cnpj']}}
    @empty($fornecedores[0]['cnpj']) {{-- Vazio = '', 0, 0.0, '0', null, false, array(), $var --}}
         VAZIO (SEM DADOS)
    @endempty
@endisset

@endisset
```

- 49 Extra - Operador condicional ternário

```php
 isset($fornecedores[0]['cnpj']) ? 'CNPJ INFORMADO' : 'CNPJ não Informado';
```

- 50 Blade - Operador condicional de valor default (??)

```php
    <p>CNPJ: {{$fornecedores[1]['cnpj'] ?? 'Dado não preenchido' }}</p>
<!--
    $variavel testada não estiver definida (isset)
    ou
    $variavel testada não possuir o valor null
 -->
```

- 51 Blade - @switch/case

```php
    <p>Telefones: {{$fornecedores[1]['ddd'] ?? ''}} {{$fornecedores[1]['telefone'] ?? ''}}</p>
    <p>
    @switch($fornecedores[1]['ddd'])
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

```

- 52 Blade - @for

```php
    @for($i = 0; isset($fornecedores[$i]); $i++)
    <p>Fornecedor: {{$fornecedores[$i]['nome']}}</p>
    <p>Status: {{$fornecedores[$i]['status']}}</p>
    <p>CNPJ: {{$fornecedores[$i]['cnpj'] ?? 'Dado não preenchido' }}</p>
    <p>Telefones: {{$fornecedores[$i]['ddd'] ?? ''}} {{$fornecedores[$i]['telefone'] ?? ''}}</p>
    <hr>
    @endfor
```

- 53 Blade - @while

```php
 @php $i = 0 @endphp
    @while(isset($fornecedores[$i]))
        <p>Fornecedor: {{$fornecedores[$i]['nome']}}</p>
        <p>Status: {{$fornecedores[$i]['status']}}</p>
        <p>CNPJ: {{$fornecedores[$i]['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedores[$i]['ddd'] ?? ''}} {{$fornecedores[$i]['telefone'] ?? ''}}</p>
        <hr>
        @php $i++ @endphp
    @endwhile
```

- 54 Blade - @foreach

```php
    @foreach($fornecedores as $indice => $fornecedor)
        <p>Fornecedor: {{$fornecedor['nome']}}</p>
        <p>Status: {{$fornecedor['status']}}</p>
        <p>CNPJ: {{$fornecedor['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedor['ddd'] ?? ''}} {{$fornecedor['telefone'] ?? ''}}</p>
        <hr>
    @endforeach
```

- 55 Blade - @forelse

```php
    @forelse($fornecedores as $indice => $fornecedor)
        <p>Fornecedor: {{$fornecedor['nome']}}</p>
        <p>Status: {{$fornecedor['status']}}</p>
        <p>CNPJ: {{$fornecedor['cnpj'] ?? 'Dado não preenchido' }}</p>
        <p>Telefones: {{$fornecedor['ddd'] ?? ''}} {{$fornecedor['telefone'] ?? ''}}</p>
        <hr>
    @empty
        <p>Não existe fornecedores Cadastrados!!!!</p>
    @endforelse
```

- 56 Blade - Escapando a tag de impressão do Blade

```php
     <p>Fornecedor: @{{$fornecedor['nome']}}</p>
```

- 57 Blade - Variável loop

```bash
{#280 ▼
  +"iteration": 1
  +"index": 0
  +"remaining": 2
  +"count": 3
  +"first": true
  +"last": false
  +"odd": true
  +"even": false
  +"depth": 1
  +"parent": null
}
```

```php
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
```

- 58 Super Gestão - Melhorando o visual
- 59 O que são assets?
- 60 Adicionando assets as views (helper asset)
- 61 Adicionando arquivos CSS externos as páginas web
- 62 Blade - Template com @extends, @section e @yield parte 1
- 63 Blade - Template com @extends, @section e @yield parte 2
- 64 Blade - Realizando include de views (@include)
- 65 Super Gestão - Enviando o formulário de contato
- 66 Enviando o formulário de contato via POST
- 67 Entendendo o token @csrf
- 68 Blade - Componentes (@component)
- 69 Blade - Enviando parâmetros para componentes

```php
{{$slot}}
<form action="{{route('site.contato')}}" method="post">
    @csrf
    <input name="nome" type="text" placeholder="Nome" class="{{ $classe }}">
    <br>
    <input name="telefone" type="text" placeholder="Telefone" class="{{ $classe }}">
    <br>
    <input name="email" type="text" placeholder="E-mail" class="{{ $classe }}">
    <br>
    <select name="motivo_contato" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        <option value="1">Dúvida</option>
        <option value="2">Elogio</option>
        <option value="3">Reclamação</option>
    </select>
    <br>
    <textarea name="mensagem" class="{{ $classe }}">Preencha aqui a sua mensagem</textarea>
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>

```

```php
            <div class="contato-principal">
                @component('site.layout._component.form_contato', ['classe' => 'borda-preta'])
                    <p>A nossa equipe vai analisar sua mensagem</p>
                    <p>Tempo de resposta 48h</p>
                @endcomponent
            </div>
```

```php
    @component('site.layout._component.form_contato', ['classe' => 'borda-branca'])
    @endcomponent
```

[Voltar ao Índice](#indice)

---


## <a name="parte8">8 - Models, Migrations, Seeders, Factories, Banco de Dados, Tinker e Eloquent ORM</a>

- 70 Criando o Model SiteContato

```
$ php artisan make:model SiteContato -m
Model created successfully.
Created Migration: 2022_07_07_131143_create_site_contatos_table

```

- 71 Implementando a migration SiteContato

```php
class CreateSiteContatosTable extends Migration
{
    public function up()
    {
        Schema::create('site_contatos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 50);
            $table->string('telefone', 20);
            $table->string('email', 80);
            $table->integer('motivo_contato');
            $table->text('mensagem');
        });
    }
```

- 72 Dica - Resolvendo problema do php artisan migrate

```
Dica importante para próxima aula enviada pelo João Vitor Moraski. A dica se aplica a você caso você esteja utilizando o sistema operacional Linux na distro Ubuntu 20.04:

Tive um problema onde sempre que tentava executar a migrate aparecia algo do tipo could not find drive (SQL: PRAGMA foreign_keys = on;).

Algumas pessoas conseguem resolver o erro tirando o ";" de trás da escrita 'extension:pdo_sqlite' no php.ini. O arquivo php ini pode ser localizado por meio do comando php -i | grep 'php.ini' ou pelo comando php --ini (os comandos devem ser executado na linha de comando do sistema operacional).

Porém, se o procedimento acima não funcionar, tente realizar a instalação da extensão em seu sistema operacional. No meu caso, na versão 20.04 do Ubuntu, ocorreu que a extensão não estava instalada por padrão. O comando utilizado na linha de comando do sistema operacional para instalar a extensão é:

sudo apt install php7.4-sqlite3 <- comando para instalar a extensão certa

Vlw João Moraski.
```

- 73 Configurando o BD SQLite e executando as migrations
- 74 [WINDOWS] SGBD MySQL - Download e Instalação
- 75 [LINUX] SGBD MySQL - Download e Instalação
- 76 [OSX] SGBD MySQL - Download e Instalação
- 77 Conectando-se ao SGBD MySQL via MySQL Workbench
- 78 Criando a base de dados da aplicação e configurando a conexão (.env)
- 79 Migration - Executando as migrações
- 80 Migration - Criando e executando a migration fornecedores
- 81 Migration - Adicionando campos a uma tabela
- 82 Migration - Métodos up e down
- 83 Migration - Modificadores Nullable e Default
- 84 Migration - Adicionando chaves estrangeiras (Relacionamento um para um)
- 85 Migration - Adicionando chaves estrangeiras (Relacionamento um para muitos)
- 86 Migration - Adicionando chaves estrangeiras (Relacionamento muitos para muitos)
- 87 Migration - Modificador After
- 88 Migration - Comandos Status, Reset, Refresh e Fresh
- 89 Entendendo o Eloquent ORM
- 90 Tinker - Introdução
- 91 Eloquent - Inserindo registros
- 92 Eloquent - Ajustando o nome da tabela no Model para um correto ORM
- 93 Eloquent - Inserindo registros com Create e Fillable
- 94 Eloquent - Selecionando registros com all()
- 95 Eloquent - Selecionando registros com find()
- 96 Eloquent - Selecionando registros com where()
- 97 Eloquent - Selecionando registros com whereIn() e whereNotIn()
- 98 Eloquent - Selecionando registros com whereBetween() e whereNotBetween()
- 99 Eloquent - Selecionando registros com dois ou mais Wheres
- 100 Eloquent - Selecionando registros com orWhere()
- 101 Eloquent - Selecionando registros com whereNull() e whereNotNull()
- 102 Eloquent - Selecionando registros com base em parâmetros do tipo data e hora
- 103 Eloquent - Selecionando registros com whereColumn()
- 104 Eloquent - Selecionando registros aplicando precedência em operações lógicas
- 105 Eloquent - Ordenando registros
- 106 Eloquent - Introdução as Collections
- 107 Eloquent - Collection first, last e reverse
- 108 Eloquent - Collection toArray e toJson
- 109 Eloquent - Collection pluck
- 110 Eloquent - Um pouco mais sobre os métodos nativos dos objetos Collection
- 111 Eloquent - Atualizando registros (save)
- 112 Eloquent - Atualizando registros (fill e save)
- 113 Eloquent - Atualizando registros (where e update)
- 114 Eloquent - Deletando registros (delete e destroy)
- 115 Eloquent - Deletando registros com SoftDelete
- 116 Eloquent - Selecionando e restaurando registros deletados com SoftDelete
- 117 Seeders parte 1
- 118 Seeders parte 2
- 119 Factories (semeando tabelas em massa com a dependência Faker)

[Voltar ao Índice](#indice)

---


## <a name="parte9">9 - Trabalhando com formulários</a>

- 120 Entendendo o objeto Request
- 121 Gravando os dados do formulário no banco de dados
- 122 Validação de campos obrigatórios (required)
- 123 Validação de quantidades mínimas e máximas de caracteres (min e max)
- 124 Repopulando o formulário (Request Old Input) parte 1
- 125 Repopulando o formulário (Request Old Input) parte 2
- 126 Ajustando o formulário de contato na rota principal
- 127 Refactoring do projeto Super Gestão parte 1
- 128 Refactoring do projeto Super Gestão parte 2
- 129 Validação de campos e-mail
- 130 Persistindo dados e redirecionando a rota
- 131 Validação de campos únicos (unique)
- 132 Customizando a apresentação dos erros de validação parte 1
- 133 Customizando a apresentação dos erros de validação parte 2
- 134 Customizando as mensagens de feedback de validação

[Voltar ao Índice](#indice)

---


## <a name="parte10">10 - Middlewares</a>

- 135 Introdução aos Middlewares
- 136 Criando meu primeiro middleware
- 137 Criando o model LogAcesso e sua migration
- 138 Implementando middlewares no método construtor dos controllers
- 139 Implementando um middleware para todas as rotas
- 140 Apelidando middlewares
- 141 Encadeamento de middlewares (criando um middleware de autenticação)
- 142 Adicionando middlewares a um grupo de rotas
- 143 Passando parâmetros para o middleware
- 144 Manipulando a resposta de uma requisição via middleware

[Voltar ao Índice](#indice)

---


## <a name="parte11">11 - Autenticação de usuários (revisando e praticando os assuntos abordados)</a>



[Voltar ao Índice](#indice)

---


## <a name="parte12">12 - Finalizando o projeto Super Gestão</a>



[Voltar ao Índice](#indice)

---


## <a name="parte13">13 - Autenticação WEB (Session) e Bootstrap (CSS)</a>



[Voltar ao Índice](#indice)

---


## <a name="parte14">14 - Implementando o envio de e-mails e a exportação de arquivos XLSX, CSV e PDF</a>



[Voltar ao Índice](#indice)

---


## <a name="parte15">15 - Adaptação para o próximo nível no domínio do Framework Laravel</a>



[Voltar ao Índice](#indice)

---


## <a name="parte16">16 - Vue.JS para iniciantes</a>



[Voltar ao Índice](#indice)

---


## <a name="parte17">17 - APIs, WebServices e Rest</a>



[Voltar ao Índice](#indice)

---


## <a name="parte18">18 - Autenticação API - Autorização JWT (JSON Web Token)</a>



[Voltar ao Índice](#indice)

---


## <a name="parte19">19 - Aplicação Full Stack Back-end API Laravel com Front-end Vue.JS</a>



[Voltar ao Índice](#indice)

---


## <a name="parte20">20 - Armazenamento em memória com Redis (Laravel Cache)</a>



[Voltar ao Índice](#indice)

---

