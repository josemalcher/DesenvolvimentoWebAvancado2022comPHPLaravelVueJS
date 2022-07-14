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

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelcursolaravel2022
DB_USERNAME=root
DB_PASSWORD=
```

```bash
$ php artisan migrate
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.03 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.03 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (0.02 seconds)
Migrating: 2022_07_07_131143_create_site_contatos_table
Migrated:  2022_07_07_131143_create_site_contatos_table (0.02 seconds)

```

- 74 [WINDOWS] SGBD MySQL - Download e Instalação
- 75 [LINUX] SGBD MySQL - Download e Instalação
- 76 [OSX] SGBD MySQL - Download e Instalação
- 77 Conectando-se ao SGBD MySQL via MySQL Workbench
- 78 Criando a base de dados da aplicação e configurando a conexão (.env)
- 79 Migration - Executando as migrações
- 80 Migration - Criando e executando a migration fornecedores

```bash
$ php artisan make:model Fornecedor 
Model created successfully.
```

```bash
$ php artisan make:migration create_fornecedores_table
Created Migration: 2022_07_07_181055_create_fornecedores_table
```


```php
class CreateFornecedoresTable extends Migration
{
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->timestamps();
        });
    }
```

```bash
$ php artisan migrate
Migrating: 2022_07_07_181055_create_fornecedores_table
Migrated:  2022_07_07_181055_create_fornecedores_table (0.02 seconds)
```

- 81 Migration - Adicionando campos a uma tabela

```php
class AlterFornecedoresNovasColunas extends Migration
{
    public function up()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2);
            $table->string('email', 150);
        });
    }
```

```
$ php artisan migrate
Migrating: 2022_07_07_181950_alter_fornecedores_novas_colunas
Migrated:  2022_07_07_181950_alter_fornecedores_novas_colunas (0.03 seconds)

```


- 82 Migration - Métodos up e down

```
Up   - php artisan migrade - Mais antiga para a mais atual
DOWN - php artisan migrade:rollback - da mais atual para a mais antiga
```

```
$ php artisan migrate:rollback
Rolling back: 2022_07_07_181950_alter_fornecedores_novas_colunas
```

````
$ php artisan migrate:rollback --step=2
Rolling back: 2022_07_07_181950_alter_fornecedores_novas_colunas
Rolled back:  2022_07_07_181950_alter_fornecedores_novas_colunas (0.01 seconds)
Rolling back: 2022_07_07_181055_create_fornecedores_table
Rolled back:  2022_07_07_181055_create_fornecedores_table (0.01 seconds)

````

- 83 Migration - Modificadores Nullable e Default

```
$ php artisan make:migration create_produtos_table
Created Migration: 2022_07_07_185435_create_produtos_table

```

```php
class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->string('nome', 100);
            $table->text('descricao')->nullable();
            $table->integer('peso')->nullable();
            $table->float('preco_venda', 8,2)->default(0.01);
            $table->integer('estoque_minimo')->default(1);
            $table->integer('estoque_maximo')->default(1);

            $table->timestamps();
        });
    }
```


- 84 Migration - Adicionando chaves estrangeiras (Relacionamento um para um)

```
$ php artisan make:migration create_produto_detalhes_table
Created Migration: 2022_07_07_190957_create_produto_detalhes_table

```

```php
class CreateProdutoDetalhesTable extends Migration
{
    public function up()
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {

            //COLUNAS
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->float('comprimento', 8,2);
            $table->float('largura', 8,2);
            $table->float('altura', 8,2);
            $table->timestamps();

            //CONSTRAINT
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unique('produto_id');

        });
    }
```

```
$ php artisan migrate
Migrating: 2022_07_07_190957_create_produto_detalhes_table
Migrated:  2022_07_07_190957_create_produto_detalhes_table (0.06 seconds)

```

- 85 Migration - Adicionando chaves estrangeiras (Relacionamento um para muitos)

```php
class CreateUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidade', 5); // cm, mm, kg
            $table->string('descricao', 30);
            $table->timestamps();
        });

        // ADICIONAR o relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        // Adicionar o relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }
    public function down()
    {
        // REMOVER o relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            // remover a FK
            $table->dropForeign('produto_detalhes_unidade_id_foreign');// [table]_[coluna]_foreign
            //remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });

        // REMOVER o relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            // remover a FK
            $table->dropForeign('produtos_unidade_id_foreign');// [table]_[coluna]_foreign
            //remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
```

- 86 Migration - Adicionando chaves estrangeiras (Relacionamento muitos para muitos)

```
$ php artisan make:migration ajuste_produtos_filiais
Created Migration: 2022_07_08_144404_ajuste_produtos_filiais

```

```php
class AjusteProdutosFiliais extends Migration
{
    public function up()
    {
        // CRIANDO tabela filiais
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        // TABELA PRODUTO_FILIAIS
        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');

            $table->timestamps();

            // foreignKey (constraints)
            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');

        });

        // REMOVENDO colunas da tabela Produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn(['preco_venda', 'estoque_minimo', 'estoque_maximo']);
        });

    }
    public function down()
    {
        Schema::table('protudos', function (Blueprint $table) {
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
        });

        Schema::dropIfExists('produto_filiais');
        Schema::dropIfExists('filiais');
    }
}
```

- 87 Migration - Modificador After

```
$ php artisan make:migration after_fornecedores_nova_coluna_site_com_after
Created Migration: 2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after

```

```php
class AfterFornecedoresNovaColunaSiteComAfter extends Migration
{
    public function up()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('site', 150)->after('nome')->nullable()->default('#');
        });
    }

    public function down()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->dropColumn('site');
        });
    }
}
```

```
$ php artisan migrate
Migrating: 2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after
Migrated:  2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after (0.04 seconds)

```

- 88 Migration - Comandos Status, Reset, Refresh e Fresh

```
$ php artisan migrate:status
+------+-----------------------------------------------------------------+-------+
| Ran? | Migration                                                       | Batch |
+------+-----------------------------------------------------------------+-------+
| Yes  | 2014_10_12_000000_create_users_table                            | 1     |
| Yes  | 2014_10_12_100000_create_password_resets_table                  | 1     |
| Yes  | 2019_08_19_000000_create_failed_jobs_table                      | 1     |
| Yes  | 2022_07_07_131143_create_site_contatos_table                    | 1     |
| Yes  | 2022_07_07_181055_create_fornecedores_table                     | 2     |
| Yes  | 2022_07_07_181950_alter_fornecedores_novas_colunas              | 2     |
| Yes  | 2022_07_07_185435_create_produtos_table                         | 3     |
| Yes  | 2022_07_07_190957_create_produto_detalhes_table                 | 4     |
| Yes  | 2022_07_07_194454_create_unidades_table                         | 4     |
| Yes  | 2022_07_08_144404_ajuste_produtos_filiais                       | 4     |
| Yes  | 2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after | 5     |
+------+-----------------------------------------------------------------+-------+

```

Comamando que apaga todo o banco, rollback de todas as migrações:

```
$ php artisan migrate:reset
```

Comando faz roolback e em seguida migrate. Recriar 
```
$ php artisan migrate:refresh

```

Faz o DROP de todos os objetos do DB + o migrate para recriar os objetos
```
$ php artisan migrate:fresh

```

- 89 Entendendo o Eloquent ORM
- 90 Tinker - Introdução
- 91 Eloquent - Inserindo registros

```
>>> $contato = new \App\SiteContato();                                                                                                                                                                                  
=> App\SiteContato {#3420}

>>> $contato->nome = 'Jose';                                                                                                                                                                                            
=> "Jose"

>>> $contato->telefone = '(91) 0000-1111';                                                                                                                                                                              
=> "(91) 0000-1111"

>>> $contato->email = 'jose@josemalcher.net';                                                                                                                                                                           
=> "jose@josemalcher.net"

>>> $contato->motivo_contato = 1;                                                                                                                                                                                       
=> 1

>>> $contato->mensagem = 'Gostaria de mais informações';                                                                                                                                                                
=> "Gostaria de mais informações"

>>> print_r($contato->getAttributes());                                                                                                                                                                                 
Array
(
    [nome] => Jose
    [telefone] => (91) 0000-1111
    [email] => jose@josemalcher.net
    [motivo_contato] => 1
    [mensagem] => Gostaria de mais informações
)
=> true

>>> $contato->save();                                                                                                                                                                                                   
=> true

```

- 92 Eloquent - Ajustando o nome da tabela no Model para um correto ORM

```php
// fornecedors
// fornecedores
class Fornecedor extends Model
{
    protected $table = 'fornecedores';
}
```

```
>>> $f2 = new \App\Fornecedor();                                                                                                                                                                                        
=> App\Fornecedor {#4209}

>>> $f2->nome = 'Fornecedor teste1';                                                                                                                                                                                    
=> "Fornecedor teste1"

>>> $f2->site= 'www.fornecedor.com';                                                                                                                                                                                    
=> "www.fornecedor.com"

>>> $f2->uf = 'PA';                                                                                                                                                                                                     
=> "PA"

>>> $f2->email = 'contato@fornecedor.com';                                                                                                                                                                              
=> "contato@fornecedor.com"

>>> print_r($f2->getattributes())                                                                                                                                                                                       
Array
(
    [nome] => Fornecedor teste1
    [site] => www.fornecedor.com
    [uf] => PA
    [email] => contato@fornecedor.com
)
=> true

>>> $f2->save()                                                                                                                                                                                                         
=> true

```


- 93 Eloquent - Inserindo registros com Create e Fillable

```php
class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = ['nome', 'site', 'uf', 'email'];
}

```

```
>>> \App\Fornecedor::create(['nome'=>'Fornecedor Fill', 'site'=> 'www.teste.com', 'uf'=> 'SP', 'email'=> 'teste@teste.com']);                                                                                           
=> App\Fornecedor {#3425
     nome: "Fornecedor Fill",
     site: "www.teste.com",
     uf: "SP",
     email: "teste@teste.com",
     updated_at: "2022-07-08 21:16:28",
     created_at: "2022-07-08 21:16:28",
     id: 2,
   }


```

- 94 Eloquent - Selecionando registros com all()

```
>>> use \App\Fornecedor;                                                                                                                                                                                                
>>> $fornecedores = Fornecedor::all();                                                                                                                                                                                  
=> Illuminate\Database\Eloquent\Collection {#3433
     all: [
       App\Fornecedor {#3421
         id: 1,
         nome: "Fornecedor teste1",
         site: "www.fornecedor.com",
         created_at: "2022-07-08 21:10:52",
         updated_at: "2022-07-08 21:10:52",
         uf: "PA",
         email: "contato@fornecedor.com",
       },
       App\Fornecedor {#3420
         id: 2,
         nome: "Fornecedor Fill",
         site: "www.teste.com",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-08 21:16:28",
         uf: "SP",
         email: "teste@teste.com",
       },
     ],
   }

```

```
>>> print_r($fornecedores->toArray());                                                                                                                                                                                  
Array
(
    [0] => Array
        (
            [id] => 1
            [nome] => Fornecedor teste1
            [site] => www.fornecedor.com
            [created_at] => 2022-07-08T21:10:52.000000Z
            [updated_at] => 2022-07-08T21:10:52.000000Z
            [uf] => PA
            [email] => contato@fornecedor.com
        )

    [1] => Array
        (
            [id] => 2
            [nome] => Fornecedor Fill
            [site] => www.teste.com
            [created_at] => 2022-07-08T21:16:28.000000Z
            [updated_at] => 2022-07-08T21:16:28.000000Z
            [uf] => SP
            [email] => teste@teste.com
        )

)
=> true

```

- 95 Eloquent - Selecionando registros com find()

```
>>> use \App\Fornecedor;                                                                                                                                                                                                
>>> $fornecedores2 = Fornecedor::find(2);                                                                                                                                                                               
=> App\Fornecedor {#3423
     id: 2,
     nome: "Fornecedor Fill",
     site: "www.teste.com",
     created_at: "2022-07-08 21:16:28",
     updated_at: "2022-07-08 21:16:28",
     uf: "SP",
     email: "teste@teste.com",
   }

>>> $fornecedores2 = Fornecedor::find([1,2]);                                                                                                                                                                           
=> Illuminate\Database\Eloquent\Collection {#3449
     all: [
       App\Fornecedor {#3417
         id: 1,
         nome: "Fornecedor teste1",
         site: "www.fornecedor.com",
         created_at: "2022-07-08 21:10:52",
         updated_at: "2022-07-08 21:10:52",
         uf: "PA",
         email: "contato@fornecedor.com",
       },
       App\Fornecedor {#3444
         id: 2,
         nome: "Fornecedor Fill",
         site: "www.teste.com",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-08 21:16:28",
         uf: "SP",
         email: "teste@teste.com",
       },
     ],
   }


```

- 96 Eloquent - Selecionando registros com where()

```
>>> use \App\SiteContato;                                                                                                                                                                                               
>>> $contatos = SiteContato::where('id', '>', 1);                                                                                                                                                                       
=> Illuminate\Database\Eloquent\Builder {#3458}

>>> $contatos = SiteContato::where('id', '>', 1)->get();                                                                                                                                                                
=> Illuminate\Database\Eloquent\Collection {#3764
     all: [],
   }

>>> $contatos = SiteContato::where('id', '>=', 1)->get();                                                                                                                                                               
=> Illuminate\Database\Eloquent\Collection {#4236
     all: [
       App\SiteContato {#3460
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

>>> $contatos = SiteContato::where('nome', 'Jose')->get();                                                                                                                                                              
=> Illuminate\Database\Eloquent\Collection {#4325
     all: [
       App\SiteContato {#4132
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

>>> $contatos = SiteContato::where('mensagem','like', '%informações%')->get();                                                                                                                                          
=> Illuminate\Database\Eloquent\Collection {#4327
     all: [
       App\SiteContato {#4384
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }


```

- 97 Eloquent - Selecionando registros com whereIn() e whereNotIn()

```
>>> use \App\SiteContato;                                                                                                                                                                                               
>>> $contatos = SiteContato::whereIn('motivo_contato', [1,3]);                                                                                                                                                          
=> Illuminate\Database\Eloquent\Builder {#4237}

>>> $contatos = SiteContato::whereIn('motivo_contato', [1,3])->get();                                                                                                                                                   
=> Illuminate\Database\Eloquent\Collection {#4386
     all: [
       App\SiteContato {#4327
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
// ...
```

```
>>> $contatos = SiteContato::whereNotIn('motivo_contato', [1,3])->get();                                                                                                                                                
=> Illuminate\Database\Eloquent\Collection {#4389
     all: [
       App\SiteContato {#4382
         id: 5,
         created_at: null,
         updated_at: null,
         nome: "André",
         telefone: "(88) 95555-6666",
         email: "andre@contato.com.br",
         motivo_contato: 2,
         mensagem: "Parabéns pela ferramenta, estou obtendo ótimos resultados!",
       },
       App\SiteContato {#4383
         id: 7,
         created_at: null,
         updated_at: null,
         nome: "Helena",
         telefone: "(11) 97777-8888",
         email: "helena@contato.com.br",
         motivo_contato: 2,
         mensagem: "Consigo controlar toda a minha empresa de modo fácil e prático.",
       },
     ],
   }


```

- 98 Eloquent - Selecionando registros com whereBetween() e whereNotBetween()

```
>>> use \App\SiteContato;                                                                                                                                                                                               
>>> $contatos = SiteContato::whereBetween('id', [3,6])->get();                                                                                                                                                          
=> Illuminate\Database\Eloquent\Collection {#4385
     all: [
       App\SiteContato {#4132
         id: 3,
         created_at: null,
         updated_at: null,
         nome: "Rosa",
         telefone: "(33) 92222-3333",
         email: "rosa@contato.com.br",
         motivo_contato: 1,
         mensagem: "Quando custa essa aplicação?",
       },
//.....
```

```
>>> $contatos = SiteContato::whereNotBetween('id', [3,6])->get();                                                                                                                                                       
=> Illuminate\Database\Eloquent\Collection {#4390
     all: [
       App\SiteContato {#4384
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },

```


- 99 Eloquent - Selecionando registros com dois ou mais Wheres

```
>>> $contatos = SiteContato::where('nome', '<>', 'Fernando')->whereIn('motivo_contato', [1,2])->whereBetween('created_at', ['2022-07-08 00:00:00', '2020-07-08 00:00:00'])->get();                                      
=> Illuminate\Database\Eloquent\Collection {#3447
     all: [],
   }

```

- 100 Eloquent - Selecionando registros com orWhere()

```
>>> $contatos = SiteContato::where('nome', '<>', 'Fernando')->orWhereIn('motivo_contato', [1,2])->orWhereBetween('created_at', ['2022-07-08 00:00:00', '2020-07-08 00:00:00'])->get();                                  
=> Illuminate\Database\Eloquent\Collection {#4385
     all: [
       App\SiteContato {#4390
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
// ....
```

- 101 Eloquent - Selecionando registros com whereNull() e whereNotNull()

```
>>> $contatos = SiteContato::whereNull('updated_at')->get();                                                                                                                                                            
=> Illuminate\Database\Eloquent\Collection {#4408
     all: [
       App\SiteContato {#4382
         id: 2,
         created_at: null,
         updated_at: null,
         nome: "João",
         telefone: "(88) 91111-2222",
         email: "joao@contato.com.br",
         motivo_contato: 3,
         mensagem: "É muito difícil localizar a opção de listar todos os produtos",
       },
// ....
```

```
>>> $contatos = SiteContato::whereNotNull('updated_at')->get();                                                                                                                                                         
=> Illuminate\Database\Eloquent\Collection {#4383
     all: [
       App\SiteContato {#3458
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }


```


- 102 Eloquent - Selecionando registros com base em parâmetros do tipo data e hora

```
>>> $contatos = SiteContato::whereDate('created_at', '2022-07-08')->get()                                                                                                                                               
=> Illuminate\Database\Eloquent\Collection {#4394
     all: [
       App\SiteContato {#4382
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

```

```
>>> $contatos = SiteContato::whereDay('created_at', '08')->get()                                                                                                                                                        
=> Illuminate\Database\Eloquent\Collection {#4416
     all: [
       App\SiteContato {#3416
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

```

```
>>> $contatos = SiteContato::whereMonth('created_at', '07')->get()                                                                                                                                                      
=> Illuminate\Database\Eloquent\Collection {#4392
     all: [
       App\SiteContato {#4398
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

```

```
>>> $contatos = SiteContato::whereYear('created_at', '2022')->get()                                                                                                                                                     
=> Illuminate\Database\Eloquent\Collection {#4387
     all: [
       App\SiteContato {#4404
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }

```

```
>>> $contatos = SiteContato::whereTime('created_at', '=', '21:01:42')->get()                                                                                                                                            
=> Illuminate\Database\Eloquent\Collection {#4395
     all: [
       App\SiteContato {#3458
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }


```


- 103 Eloquent - Selecionando registros com whereColumn()

```
>>> use \App\SiteContato;                                                                                                                                                                                               
>>> $contatos = SiteContato::whereColumn('created_at', 'updated_at')->get()                                                                                                                                             
=> Illuminate\Database\Eloquent\Collection {#4385
     all: [
       App\SiteContato {#4382
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
     ],
   }
b
```

```
>>> $contatos = SiteContato::whereColumn('created_at','<>', 'updated_at')->get()                                                                                                                                        
=> Illuminate\Database\Eloquent\Collection {#4412
     all: [],
   }

```


- 104 Eloquent - Selecionando registros aplicando precedência em operações lógicas

```
>>> $contatos = SiteContato::where(function($query){$query->where('nome', 'Jorge')->orWhere('nome', 'Ana');})
                           ->where(function($query){$query->whereIn('motivo_contato', [1,2])->orWhere('id', [4,6]);})
                           ->get();         
=> Illuminate\Database\Eloquent\Collection {#4402
     all: [],
   }


```

- 105 Eloquent - Ordenando registros

```
>>> use \App\SiteContato;       
>>> $contato = SiteContato::all();                                                                                                                                                                                      
=> Illuminate\Database\Eloquent\Collection {#4358
     all: [
       App\SiteContato {#4359
         id: 1,
         created_at: "2022-07-08 21:01:42",
         updated_at: "2022-07-08 21:01:42",
         nome: "Jose",
         telefone: "(91) 0000-1111",
         email: "jose@josemalcher.net",
         motivo_contato: 1,
         mensagem: "Gostaria de mais informações",
       },
//....
```

```
>>> $contato = SiteContato::orderBy('nome', 'asc')->get();                                                                                                                                                              
=> Illuminate\Database\Eloquent\Collection {#4367
     all: [
       App\SiteContato {#4368
         id: 6,
         created_at: null,
         updated_at: null,
         nome: "Ana",
         telefone: "(33) 96666-7777",
         email: "ana@contato.com.br",
         motivo_contato: 3,
         mensagem: "Não gostei muito das cores, consigo mudar de tema?",
       },
// .....

>>> $contato = SiteContato::orderBy('motivo_contato')->orderBy('nome')->get();                                                                                                                                          
=> Illuminate\Database\Eloquent\Collection {#3739
     all: [
       App\SiteContato {#3418
         id: 4,
         created_at: null,
         updated_at: null,
         nome: "Fernando",
         telefone: "(11) 94444-5555",
         email: "fernando@contato.com.br",
         motivo_contato: 1,
         mensagem: "Como consigo criar multiplos usuários para minha empresa?",
       },
// .....
```

- 106 Eloquent - Introdução as Collections
- 107 Eloquent - Collection first, last e reverse

```
>>> use \App\SiteContato;                                                                                                                                                                                               
>>> $contato = SiteContato::where('id', '>', 3);                                                                                                                                                                        
=> Illuminate\Database\Eloquent\Builder {#4373}

>>> $contato = SiteContato::where('id', '>', 3)->get();                                                                                                                                                                 
=> Illuminate\Database\Eloquent\Collection {#3739
     all: [
       App\SiteContato {#4146
         id: 4,
         created_at: null,
         updated_at: null,
         nome: "Fernando",
         telefone: "(11) 94444-5555",
         email: "fernando@contato.com.br",
         motivo_contato: 1,
         mensagem: "Como consigo criar multiplos usuários para minha empresa?",
       },
// .....
```

```
>>> $contato->first();                                                                                                                                                                                                  
=> App\SiteContato {#4146
     id: 4,
     created_at: null,
     updated_at: null,
     nome: "Fernando",
     telefone: "(11) 94444-5555",
     email: "fernando@contato.com.br",
     motivo_contato: 1,
     mensagem: "Como consigo criar multiplos usuários para minha empresa?",
   }

>>> $contato->last();                                                                                                                                                                                                   
=> App\SiteContato {#4354
     id: 7,
     created_at: null,
     updated_at: null,
     nome: "Helena",
     telefone: "(11) 97777-8888",
     email: "helena@contato.com.br",
     motivo_contato: 2,
     mensagem: "Consigo controlar toda a minha empresa de modo fácil e prático.",
   }

>>> $contato->reverse();                                                                                                                                                                                                
=> Illuminate\Database\Eloquent\Collection {#4366
     all: [
       3 => App\SiteContato {#4354
         id: 7,
         created_at: null,
         updated_at: null,
         nome: "Helena",
         telefone: "(11) 97777-8888",
         email: "helena@contato.com.br",
         motivo_contato: 2,
         mensagem: "Consigo controlar toda a minha empresa de modo fácil e prático.",
       },
// .....
```


- 108 Eloquent - Collection toArray e toJson

```
>>> SiteContato::all()->toArray();                                                                                                                                                                                      
=> [
     [
       "id" => 1,
       "created_at" => "2022-07-08T21:01:42.000000Z",
       "updated_at" => "2022-07-08T21:01:42.000000Z",
       "nome" => "Jose",
       "telefone" => "(91) 0000-1111",
       "email" => "jose@josemalcher.net",
       "motivo_contato" => 1,
       "mensagem" => "Gostaria de mais informações",
     ],
// ......
```

```
>>> SiteContato::all()->toJson();                                                                                                                                                                                       
=> "[{"id":1,"created_at":"2022-07-08T21:01:42.000000Z","updated_at":"2022-07-08T21:01:42.000000Z","nome":"Jose","telefone":"(91) 0000-1111","email":"jose@josemalcher.net","motivo_contato":1,"mensagem":"Gostaria de m
ais informa\u00e7\u00f5es"},{"id":2,"created_at":null,"updated_at":null,"nome":"Jo\u00e3o","telefone":"(88) 91111-2222","email":"joao@contato.com.br","motivo_contato":3,"mensagem":"\u00c9 muito dif\u00edcil localizar
 a op\u00e7\u00e3o de listar todos os produtos"},
 // .....
```


- 109 Eloquent - Collection pluck

```
>>> SiteContato::all()->pluck('email');                                                                                                                                                                                 
=> Illuminate\Support\Collection {#4358
     all: [
       "jose@josemalcher.net",
       "joao@contato.com.br",
       "rosa@contato.com.br",
       "fernando@contato.com.br",
       "andre@contato.com.br",
       "ana@contato.com.br",
       "helena@contato.com.br",
     ],
   }

>>> SiteContato::all()->pluck('email')->toArray();                                                                                                                                                                      
=> [
     "jose@josemalcher.net",
     "joao@contato.com.br",
     "rosa@contato.com.br",
     "fernando@contato.com.br",
     "andre@contato.com.br",
     "ana@contato.com.br",
     "helena@contato.com.br",
   ]

>>> SiteContato::all()->pluck('email','nome');                                                                                                                                                                          
=> Illuminate\Support\Collection {#4364
     all: [
       "Jose" => "jose@josemalcher.net",
       "João" => "joao@contato.com.br",
       "Rosa" => "rosa@contato.com.br",
       "Fernando" => "fernando@contato.com.br",
       "André" => "andre@contato.com.br",
       "Ana" => "ana@contato.com.br",
       "Helena" => "helena@contato.com.br",
     ],
   }


```

- 110 Eloquent - Um pouco mais sobre os métodos nativos dos objetos Collection

    - [https://laravel.com/docs/7.x/collections](https://laravel.com/docs/7.x/collections)

- 111 Eloquent - Atualizando registros (save)

```
>>> use \App\Fornecedor;
                                                                                                                                                                                                
>>> $fornecedor = Fornecedor::find(1);                                                                                                                                                                                  
=> App\Fornecedor {#3416
     id: 1,
     nome: "Fornecedor teste1",
     site: "www.fornecedor.com",
     created_at: "2022-07-08 21:10:52",
     updated_at: "2022-07-08 21:10:52",
     uf: "PA",
     email: "contato@fornecedor.com",
   }

>>> $fornecedor->nome = 'Fornecedor 123';                                                                                                                                                                               
=> "Fornecedor 123"

>>> $fornecedor->site = 'www.fornecedor123.com';                                                                                                                                                                        
=> "www.fornecedor123.com"

>>> $fornecedor->email = 'fornecedor123@fornecedor123.com';                                                                                                                                                             
=> "fornecedor123@fornecedor123.com"

>>> $fornecedor->save();                                                                                                                                                                                                
=> true

>>> $fornecedor = Fornecedor::find(1);                                                                                                                                                                                  
=> App\Fornecedor {#4375
     id: 1,
     nome: "Fornecedor 123",
     site: "www.fornecedor123.com",
     created_at: "2022-07-08 21:10:52",
     updated_at: "2022-07-11 00:55:31",
     uf: "PA",
     email: "fornecedor123@fornecedor123.com",
   }


```

- 112 Eloquent - Atualizando registros (fill e save)

```
>>> $fornecedor2 = Fornecedor::find(2);                                                                                                                                                                                 
=> App\Fornecedor {#4364
     id: 2,
     nome: "Fornecedor Fill",
     site: "www.teste.com",
     created_at: "2022-07-08 21:16:28",
     updated_at: "2022-07-08 21:16:28",
     uf: "SP",
     email: "teste@teste.com",
   }

>>> $fornecedor2->fill(['nome'=> 'FORNECEDOR 321', 'site' => 'www.fornece312.com']);                                                                                                                                    
=> App\Fornecedor {#4364
     id: 2,
     nome: "FORNECEDOR 321",
     site: "www.fornece312.com",
     created_at: "2022-07-08 21:16:28",
     updated_at: "2022-07-08 21:16:28",
     uf: "SP",
     email: "teste@teste.com",
   }

>>> $fornecedor2->save();                                                                                                                                                                                               
=> true

```

```php
class Fornecedor extends Model
{
    protected $table = 'fornecedores';

    protected $fillable = ['nome', 'site', 'uf', 'email'];
}
```


- 113 Eloquent - Atualizando registros (where e update)

```
>>> Fornecedor::whereIn('id', [1,2])->get();                                                                                                                                                                            
=> Illuminate\Database\Eloquent\Collection {#4361
     all: [
       App\Fornecedor {#4390
         id: 1,
         nome: "Fornecedor 123",
         site: "www.fornecedor123.com",
         created_at: "2022-07-08 21:10:52",
         updated_at: "2022-07-11 00:55:31",
         uf: "PA",
         email: "fornecedor123@fornecedor123.com",
       },
       App\Fornecedor {#3416
         id: 2,
         nome: "FORNECEDOR 321",
         site: "www.fornece312.com",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-11 01:07:26",
         uf: "SP",
         email: "teste@teste.com",
       },
     ],
   }

>>> Fornecedor::whereIn('id', [1,2])->update(['nome'=> 'FORNECEDOR TESTE', 'site'=> 'www.teste.com.br']);                                                                                                               
=> 2

```

- 114 Eloquent - Deletando registros (delete e destroy)

```
>>> use \App\SiteContato;                                                                                                                                                                                               

>>> $contato = SiteContato::find(4);                                                                                                                                                                                    
=> App\SiteContato {#4209
     id: 4,
     created_at: null,
     updated_at: null,
     nome: "Fernando",
     telefone: "(11) 94444-5555",
     email: "fernando@contato.com.br",
     motivo_contato: 1,
     mensagem: "Como consigo criar multiplos usuários para minha empresa?",
   }

>>> $contato->delete();                                                                                                                                                                                                 
=> true

```

```
>>> SiteContato::where('id', 7)->delete();                                                                                                                                                                              
=> 1

```

```
>>> SiteContato::destroy(5);                                                                                                                                                                                            
=> 1

```


- 115 Eloquent - Deletando registros com SoftDelete

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];
}

```

```
$ php artisan make:migration alter_fornecedores_nova_coluna_softdelete
Created Migration: 2022_07_11_145643_alter_fornecedores_nova_coluna_softdelete

```

```php
 public function up()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
```

```
>>> use \App\Fornecedor;                                                                                                                                                                                                
>>> $fornecedor = Fornecedor::find(2)                                                                                                                                                                                   
=> App\Fornecedor {#3442
     id: 2,
     nome: "FORNECEDOR TESTE",
     site: "www.teste.com.br",
     created_at: "2022-07-08 21:16:28",
     updated_at: "2022-07-11 01:11:35",
     uf: "SP",
     email: "teste@teste.com",
     deleted_at: null,
   }

>>> $fornecedor->delete();                                                                                                                                                                                              
=> true

>>> $fornecedor = Fornecedor::find(2)                                                                                                                                                                                   
=> null


```

```
>>> $fornecedor->forceDelete();  // força o delete, apagar o registro
```


- 116 Eloquent - Selecionando e restaurando registros deletados com SoftDelete

```
>>> Fornecedor::withTrashed()->get();                                                                                                                                                                                   
=> Illuminate\Database\Eloquent\Collection {#3448
     all: [
       App\Fornecedor {#3449
         id: 1,
         nome: "FORNECEDOR TESTE",
         site: "www.teste.com.br",
         created_at: "2022-07-08 21:10:52",
         updated_at: "2022-07-11 01:11:35",
         uf: "PA",
         email: "fornecedor123@fornecedor123.com",
         deleted_at: null,
       },
       App\Fornecedor {#3450
         id: 2,
         nome: "FORNECEDOR TESTE",
         site: "www.teste.com.br",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-11 15:01:20",
         uf: "SP",
         email: "teste@teste.com",
         deleted_at: "2022-07-11 15:01:20",
       },
     ],
   }

```

```
>>> Fornecedor::onlyTrashed()->get();                                                                                                                                                                                   
=> Illuminate\Database\Eloquent\Collection {#3413
     all: [
       App\Fornecedor {#3423
         id: 2,
         nome: "FORNECEDOR TESTE",
         site: "www.teste.com.br",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-11 15:01:20",
         uf: "SP",
         email: "teste@teste.com",
         deleted_at: "2022-07-11 15:01:20",
       },
     ],
   }

```

```
>>> $fornecedor = Fornecedor::withTrashed()->get();                                                                                                                                                                     
=> Illuminate\Database\Eloquent\Collection {#3430
     all: [
       App\Fornecedor {#3439
         id: 1,
         nome: "FORNECEDOR TESTE",
         site: "www.teste.com.br",
         created_at: "2022-07-08 21:10:52",
         updated_at: "2022-07-11 01:11:35",
         uf: "PA",
         email: "fornecedor123@fornecedor123.com",
         deleted_at: null,
       },
       App\Fornecedor {#3454
         id: 2,
         nome: "FORNECEDOR TESTE",
         site: "www.teste.com.br",
         created_at: "2022-07-08 21:16:28",
         updated_at: "2022-07-11 15:01:20",
         uf: "SP",
         email: "teste@teste.com",
         deleted_at: "2022-07-11 15:01:20",
       },
// .....

>>> $fornecedor[1]->restore();                                                                                                                                                                                          
=> true

>>> $fornecedor = Fornecedor::find(2);                                                                                                                                                                                  
=> App\Fornecedor {#3459
     id: 2,
     nome: "FORNECEDOR TESTE",
     site: "www.teste.com.br",
     created_at: "2022-07-08 21:16:28",
     updated_at: "2022-07-11 15:10:49",
     uf: "SP",
     email: "teste@teste.com",
     deleted_at: null,
   }


```


- 117 Seeders parte 1

```
$ php artisan migrate:fresh
Dropped all tables successfully.
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.03 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.02 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (0.01 seconds)
Migrating: 2022_07_07_131143_create_site_contatos_table
Migrated:  2022_07_07_131143_create_site_contatos_table (0.01 seconds)
Migrating: 2022_07_07_181055_create_fornecedores_table
Migrated:  2022_07_07_181055_create_fornecedores_table (0.01 seconds)
Migrating: 2022_07_07_181950_alter_fornecedores_novas_colunas
Migrated:  2022_07_07_181950_alter_fornecedores_novas_colunas (0.02 seconds)
Migrating: 2022_07_07_185435_create_produtos_table
Migrated:  2022_07_07_185435_create_produtos_table (0.01 seconds)
Migrating: 2022_07_07_190957_create_produto_detalhes_table
Migrated:  2022_07_07_190957_create_produto_detalhes_table (0.05 seconds)
Migrating: 2022_07_07_194454_create_unidades_table
Migrated:  2022_07_07_194454_create_unidades_table (0.11 seconds)
Migrating: 2022_07_08_144404_ajuste_produtos_filiais
Migrated:  2022_07_08_144404_ajuste_produtos_filiais (0.11 seconds)
Migrating: 2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after
Migrated:  2022_07_08_193649_after_fornecedores_nova_coluna_site_com_after (0.02 seconds)
Migrating: 2022_07_11_145643_alter_fornecedores_nova_coluna_softdelete
Migrated:  2022_07_11_145643_alter_fornecedores_nova_coluna_softdelete (0.02 seconds)
```

```
$ php artisan make:seeder FornecedorSeeder
Seeder created successfully.

```

```php
class FornecedorSeeder extends Seeder
{
    public function run()
    {
        //instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contato@fornecedor100.com.br';
        $fornecedor->save();

        //o método create (atenção para o atributo fillable da classe)
        Fornecedor::create([
            'nome' => 'Fornecedor 200',
            'site' => 'fornecedor200.com.br',
            'uf' => 'RS',
            'email' => 'contato@fornecedor200.com.br'
        ]);

        //insert (sem tratamento do laravel)
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 300',
            'site' => 'fornecedor300.com.br',
            'uf' => 'SP',
            'email' => 'contato@fornecedor300.com.br'
        ]);   //
    }
}
```

```php
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(FornecedorSeeder::class);
    }
}
```

```
$ php artisan db:seed
Seeding: FornecedorSeeder
Seeded:  FornecedorSeeder (0.03 seconds)
Database seeding completed successfully.

```

- 118 Seeders parte 2

```
$ php artisan make:seeder SiteContatoSeeder
Seeder created successfully.
```

```php
class SiteContatoSeeder extends Seeder
{
    public function run()
    {
        //
        $contato = new SiteContato();
        $contato->nome = 'Sistema SG';
        $contato->telefone = '(11) 99999-8888';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão';
        $contato->save();
    }
}
```

```
$ php artisan db:seed --class=SiteContatoSeeder
Database seeding completed successfully.

```

- 119 Factories (semeando tabelas em massa com a dependência Faker)

```
$ php artisan make:factory SiteContatoFactory --model=SiteContato
Factory created successfully.

```

```php
$factory->define(SiteContato::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->tollFreePhoneNumber,
        'email' => $faker->unique()->email,
        'motivo_contato' => $faker->numberBetween(1,3),
        'mensagem' => $faker->text(200)
    ];
});
```

```php
class SiteContatoSeeder extends Seeder
{
    public function run()
    {
        factory(SiteContato::class, 100)->create();
    }
}
```

```
$ php artisan db:seed --class=SiteContatoSeeder
Database seeding completed successfully.

```


[Voltar ao Índice](#indice)

---


## <a name="parte9">9 - Trabalhando com formulários</a>

- 120 Entendendo o objeto Request
- 121 Gravando os dados do formulário no banco de dados

```php
class SiteContato extends Model
{
    protected $fillable = ['nome', 'telefone', 'email', 'motivo_contato', 'mensagem'];
}
```

```php
class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        /*
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        echo $request->input('nome');
        echo '<br>';
        echo $request->input('email');
        */
        /*
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');

        // print_r($contato->getAttributes());
        $contato->save();
        */

        $contato = new SiteContato();
        $contato->create($request->all());
        // $contato->save();
        // print_r($contato->getAttributes());

        return view('site.contato', ['titulo' => 'Contato (teste)']);
    }
}

```

- 122 Validação de campos obrigatórios (required)
- 123 Validação de quantidades mínimas e máximas de caracteres (min e max)

```php
class ContatoController extends Controller
{
    public function salvar(Request $request)
    {
        //realizar a validação dos dados do formulário recebidos no request
        $request->validate([
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'required',
            'motivo_contato' => 'required',
            'mensagem' => 'required|max:2000'
        ]);
        // SiteContato::create($request->all());
    }
}
```

- 124 Repopulando o formulário (Request Old Input) parte 1
- 125 Repopulando o formulário (Request Old Input) parte 2

```php
{{ $slot }}
<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    <br>

    <select name="motivo_contato" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>

        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{$key}}" {{ old('motivo_contato') == $key ? 'selected' : '' }}>{{$motivo_contato}}</option>
        @endforeach
    </select>
    <br>
    <textarea name="mensagem"
              class="{{ $classe }}">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>

<div style="position:absolute; top:0px; width:100%; background:red">
    <pre>
    {{ print_r($errors) }}
    </pre>
</div>

```

- 126 Ajustando o formulário de contato na rota principal
- 127 Refactoring do projeto Super Gestão parte 1

```
$ php artisan make:model MotivoContato -m
Model created successfully.
Created Migration: 2022_07_12_211142_create_motivo_contatos_table

```

```php
class CreateMotivoContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_contatos', function (Blueprint $table) {
            $table->id();
            $table->string('motivo_contato', 20);
            $table->timestamps();
        });
        /*
        MotivoContato::create(['Dúvida']);
        MotivoContato::create(['Elogio']);
        MotivoContato::create(['Reclamação']);
        */
    }

```

```
$php artisan make:seeder MotivoContatoSeeder
Seeder created successfully.
```

```php
class MotivoContatoSeeder extends Seeder
{
    public function run()
    {
        MotivoContato::create(['motivo_contato'=>'Dúvida']);
        MotivoContato::create(['motivo_contato'=>'Elogio']);
        MotivoContato::create(['motivo_contato'=>'Reclamação']);
    }
}
```

```
$ php artisan migrate
Migrating: 2022_07_12_211142_create_motivo_contatos_table
Migrated:  2022_07_12_211142_create_motivo_contatos_table (0.02 seconds)
```

```
$ php artisan db:seed --class=MotivoContatoSeeder
Database seeding completed successfully.

```

```php
class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        /*$motivo_contatos = [
             '1' => 'Dúvida',
             '2' => 'Elogio',
             '3' => 'Reclamação'
         ];*/
        $motivo_contatos = MotivoContato::all();
        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

```

```php
    <select name="motivo_contato" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>

        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{$motivo_contato->id}}" {{ old('motivo_contato') == $motivo_contato->id ? 'selected' : '' }}>{{$motivo_contato->motivo_contato}}</option>
        @endforeach
    </select>
```


- 128 Refactoring do projeto Super Gestão parte 2

```
$ php artisan make:migration alter_table_site_contatos_add_fk_motivo_contatos
Created Migration: 2022_07_12_214547_alter_table_site_contatos_add_fk_motivo_contatos

```

```php
class AlterTableSiteContatosAddFkMotivoContatos extends Migration
{
    public function up()
    {
        // adicionando a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id');
        });

        //atribuindo motivo_contato para a nova coluna motivo_contatos_id
        DB::statement('update site_contatos set motivo_contatos_id = motivo_contato');

        // criando a fk e removendo a coluna motivo_contato
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
            $table->dropColumn('motivo_contato');
        });
    }
    public function down()
    {
        // criar a coluna motivo_contato e removendo a fk
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo_contato');
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

        // atribuindo motivo_contatos_id para a coluna motivo_contato
        DB::statement('update site_contatos set motivo_contato = motivo_contatos_id');

        // removendo a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
    }
}
```

```
$ php artisan migrate
Migrating: 2022_07_12_214547_alter_table_site_contatos_add_fk_motivo_contatos
Migrated:  2022_07_12_214547_alter_table_site_contatos_add_fk_motivo_contatos (0.18 seconds)

```

- 129 Validação de campos e-mail
- 130 Persistindo dados e redirecionando a rota
- 131 Validação de campos únicos (unique)

```php
 public function salvar(Request $request)
    {
        //realizar a validação dos dados do formulário recebidos no request
        $request->validate([
            'nome' => 'required|min:3|max:40|unique:site_contatos', // <============
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ]);
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
```

- 132 Customizando a apresentação dos erros de validação parte 1

```php
@if($errors->any())
    <div style="position:absolute; top:0px; width:100%; background:red">
        @foreach($errors->all() as $erro)
            {{$erro}} <br>
        @endforeach
    </div>
@endif
```

- 133 Customizando a apresentação dos erros de validação parte 2

```php
{{ $slot }}
<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    @if ($errors->has('nome'))
        {{ $errors->first('nome') }}
    @endif
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    {{ $errors->has('email') ? $errors->first('email') : '' }}
    <br>

    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>

        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{$motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}>{{$motivo_contato->motivo_contato}}</option>
        @endforeach
    </select>
    {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }}
    <br>
    <textarea name="mensagem" class="{{ $classe }}">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>

@if($errors->any())
    <div style="position:absolute; top:0px; width:100%; background:red">

        @foreach ($errors->all() as $erro)
            {{ $erro }}
            <br >
        @endforeach

    </div>
@endif


```

- 134 Customizando as mensagens de feedback de validação

```php
public function salvar(Request $request)
    {
        //realizar a validação dos dados do formulário recebidos no request
        $regras =             [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'nome.unique' => 'O nome informado já está em uso',

            'email.email' => 'O email informado não é válido',

            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',

            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
```

[Voltar ao Índice](#indice)

---


## <a name="parte10">10 - Middlewares</a>

- 135 Introdução aos Middlewares
- 136 Criando meu primeiro middleware

```
$ php artisan make:middleware LogAcessMiddleware
Middleware created successfully.

```

```php
Route::middleware(LogAcessMiddleware::class)
    ->get('/', 'PrincipalController@principal')
    ->name('site.index');

```

```php
class LogAcessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request - Manipular
        // return $next($request);
        //response - Manipular
        return Response('Middleware e parei nele');
    }
}
```


- 137 Criando o model LogAcesso e sua migration

```
$ php artisan make:model LogAcesso -m
Model created successfully.
Created Migration: 2022_07_14_184449_create_log_acessos_table

```

```php
class CreateLogAcessosTable extends Migration
{
    public function up()
    {
        Schema::create('log_acessos', function (Blueprint $table) {
            $table->id();
            $table->string('log', 200);
            $table->timestamps();
        });
    }
```

```php
class LogAcesso extends Model
{
    protected $fillable = ['log'];
}
```

```php
class LogAcessMiddleware
{
    public function handle($request, Closure $next)
    {
        // $request - Manipular

        // return $next($request);
        //response - Manipular
        // dd($request);
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log'=> "IP $ip requisitou a rorta $rota"]);
        return Response($ip);
    }
}
```


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

