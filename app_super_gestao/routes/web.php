<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessMiddleware;
use App\Http\Middleware\AutenticacaoMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return "Página inicial....";
});*/

/*Route::get('/contato', function () {
    return "Contato";
});
Route::get('/sobre-nos', function () {
    return "Sobre Nós";
});*/
/*Route::get('/', 'PrincipalController@principal')
    ->name('site.index')
    ->middleware(LogAcessoMiddleware::class);*/
/*Route::middleware(LogAcessMiddleware::class)
    ->get('/', 'PrincipalController@principal')
    ->name('site.index');*/
Route::get('/', 'PrincipalController@principal')
    ->name('site.index')
    ->middleware('log.acesso');

Route::get('/sobre-nos', 'SobrenosController@sobrenos')->name('site.sobrenos');

Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

/*Route::get(
    '/contato/{nome}/{categoria_id}',
    function (
        string $nome = 'Desconhecido',
        int    $categoria_id = 1 // 1- 'informação'
    ) {
        echo "Nome: " . $nome . ' Categoria = ' . $categoria_id;
    })
        ->where('categoria_id', '[0-9+]')
        ->where('nome', '[A-Za-z]+');*/

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function () {

    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');

    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');

    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    // Produtos
    // Route::get('/produto',      'ProdutoController@index')      ->name('app.produto');
    Route::resource('produto', 'ProdutoController');

    // Produtos Detalhes
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    // Route::get('/cliente',      'ClienteController@index')      ->name('app.cliente');
    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');
    // Route::resource('pedido-produto', 'PedidoProdutoController');
    Route::get( 'pedido-produto/create/{pedido}', 'PedidoProdudoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}',  'PedidoProdudoController@store') ->name('pedido-produto.store');

    //Route::delete('pedido-produto/destroy/{pedido}/{produto}',  'PedidoProdudoController@destroy') ->name('pedido-produto.destroy');
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido_id}',  'PedidoProdudoController@destroy') ->name('pedido-produto.destroy');

});

/*
Route::get('/rota1', function (){
    echo 'ROTA 1';
})->name('site.rota1');

Route::get('/rota2', function (){
    return redirect()->route('site.rota1');
})->name('site.rota2');
// Route::redirect('/rota2', '/rota1');*/

Route::fallback(function () {
    echo 'A Rota não existe - <a href="' . route('site.index') . '">Voltar</a>';
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');
