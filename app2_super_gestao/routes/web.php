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

