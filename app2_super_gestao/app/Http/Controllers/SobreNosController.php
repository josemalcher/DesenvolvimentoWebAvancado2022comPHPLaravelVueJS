<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    public function sobre()
    {
        return view('site.sobre-nos');
    }
}
