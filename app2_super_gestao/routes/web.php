<?php

use App\Http\Controllers\{PrincipalController, SobreNosController, ContatoController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre', [SobreNosController::class, 'sobre'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');

Route::get('/login', function (){return 'Clientes';})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function (){return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores',  function (){return 'Fornecedores';})->name('app.fornecedores');
    Route::get('/produtos',  function (){return 'Produtos';})->name('app.produtos');

});

Route::get('/rota1', function (){
    echo 'ROTA 1';
})->name('site.rota1');

//Route::get('/rota2', function (){
//    return redirect()->route('site.rota1');
//})->name('site.rota2');

Route::redirect('/rota2', '/rota1');

/*
 Route::get('/contato/{nome}/{categoria_id}',
    function (
        string $nome = 'Desconhecido',
        int    $categoria_id = 1 // 1 - 'informação'
    ) {
        echo "Nome: " . $nome . ' Categoria = ' . $categoria_id;
    })
    ->where('categoria_id', '[0-9+]')
    ->where('nome', '[A-Za-z]+');
*/
Route::fallback(function () {
    echo 'A Rota não existe - <a href="'. route('site.index') .'">Voltar</a>';
});
