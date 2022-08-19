<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/', function (){
//    return ['chegamos ate aqui' => 'SIM'];
//});

// Route::resource('cliente', 'App\Http\Controllers\ClienteController');
Route::apiResource('cliente', 'App\Http\Controllers\ClienteController')->middleware('jwt.auth');
Route::apiResource('carro', 'App\Http\Controllers\CarroController')->middleware('jwt.auth');
Route::apiResource('locacao', 'App\Http\Controllers\LocacaoController')->middleware('jwt.auth');
Route::apiResource('marca', 'App\Http\Controllers\MarcaController')->middleware('jwt.auth');
Route::apiResource('modelo', 'App\Http\Controllers\ModeloController')->middleware('jwt.auth');

Route::post('login',    'App\Http\Controllers\AuthController@login');
Route::post('logout',   'App\Http\Controllers\AuthController@logout');
Route::post('refresh',  'App\Http\Controllers\AuthController@refresh');
Route::post('me',       'App\Http\Controllers\AuthController@me');
