<?php

use App\Http\Controllers\{PrincipalController,ContatoController, SobreNosController};
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return "OLÀ";
});*/

/*Route::get('/sobre-nos', function () {
    return "SOBRE";
});
Route::get('/contato', function () {
    return "CONTATO";
});*/
Route::get('/',         [PrincipalController::class, 'principal']);
Route::get('/sobre',    [SobreNosController::class, 'sobrenos']);
Route::get('/contato',  [ContatoController::class, 'contato']);
