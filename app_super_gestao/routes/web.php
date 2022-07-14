<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessMiddleware;
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
Route::middleware(LogAcessMiddleware::class)
    ->get('/', 'PrincipalController@principal')
    ->name('site.index');


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

Route::get('/login', 'ContatoController@contato')->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function () {return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', 'FornecedorController@index')->name('app.fornecedores');
    Route::get('/produtos', function () {return 'Produtos';})->name('app.produtos');
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
