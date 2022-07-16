<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $titulo = 'Login do Usuário';

        return view('site.login', compact('titulo'));
    }
}
