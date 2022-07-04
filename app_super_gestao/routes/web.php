<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'PrincipalController@principal');
Route::get('/sobre-nos', 'SobrenosController@sobrenos');
Route::get('/contato', 'ContatoController@contato');

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
