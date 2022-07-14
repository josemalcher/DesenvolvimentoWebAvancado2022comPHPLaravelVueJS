<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessMiddleware;
use Illuminate\Http\Request;

class SobrenosController extends Controller
{
    public function __construct()
    {
        $this->middleware('log.acesso');
    }

    public function sobrenos()
    {
        return view('site.sobre-nos');
    }
}
