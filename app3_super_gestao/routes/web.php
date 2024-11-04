<?php

use App\Http\Controllers\{PrincipalController,ContatoController, SobreNosController,TesteController};
use Illuminate\Support\Facades\Route;


Route::get('/',         [PrincipalController::class, 'principal'])->name('site.index');;
Route::get('/sobre',    [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');
Route::get('/contato',  [ContatoController::class, 'contato'])->name('site.contato');

Route::get('/login', function () {return 'Login';})->name('site.login');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function (){return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores',  function (){return 'Fornecedores';})->name('app.fornecedores');
    Route::get('/produtos',  function (){return 'Produtos';})->name('app.produtos');

});


Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');



Route::fallback(function () {
    echo 'A Rota não existe - <a href="'. route('site.index') .'">Voltar</a>';
});

