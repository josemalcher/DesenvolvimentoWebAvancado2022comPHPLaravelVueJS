<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {

        // var_dump($_POST);
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        echo '<br>';
        echo $request->input('name');
        echo '<br>';
        echo $request->input('mensage');

        return view('site.contato', ['titulo'=> 'Contato']);
    }
}
