<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        //$fornecedores = ['Fornecedor 1'];
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '123123123',
                'ddd' => '11',
                'telefone' => '123123123',
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'N',
                'cnpj' => '123123123',
                'ddd' => '91',
                'telefone' => '987654321',
            ]
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
