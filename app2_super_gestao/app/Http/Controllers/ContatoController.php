<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
/*
        // var_dump($_POST);
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        echo '<br>';
        echo $request->input('name');
        echo '<br>';
        echo $request->input('mensage');
*/

        $contato = new SiteContato();
        // $contato->fill($request->all());
        // $contato->save();
        // print_r($contato->getAttributes());
        $contato->create($request->all());

        return view('site.contato', ['titulo' => 'Contato (teste)']);
    }
}
