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

Route::get('/', [PrincipalController::class, 'principal']);
Route::get('/sobre', [SobreNosController::class, 'sobre']);
Route::get('/contato', [ContatoController::class, 'contato']);

Route::prefix('/app')->group(function () {
    Route::get('/clientes', function (){return 'Clientes';});
    Route::get('/fornecedores',  function (){return 'Fornecedores';});
    Route::get('/produtos',  function (){return 'Produtos';});

});
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
