<?php

use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify'=> true]);

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');*/
//Route::get('/tarefa', [App\Http\Controllers\TarefaController::class, 'index'])
//    ->name('tarefa')
//    ->middleware('verified');

Route::get('tarefa/exportacao/{extensao}', 'App\Http\Controllers\TarefaController@exportacao')
->name('tarefa.exportacao');
Route::resource('tarefa', 'App\Http\Controllers\TarefaController');


Route::get('/mensagem-teste', function (){
    return new \App\Mail\MensagemTesteMail();

    // Mail::to('contato@josemalcher.net')->send(new \App\Mail\MensagemTesteMail());
    // return 'Email enviado com sucesso';
});
