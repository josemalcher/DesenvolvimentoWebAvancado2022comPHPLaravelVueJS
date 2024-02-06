<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = ['fornecedor 1'];
        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
