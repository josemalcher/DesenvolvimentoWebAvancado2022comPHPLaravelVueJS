<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => null,
                'ddd' => '11',
                'tel' => '08080-9900'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'N',
                'cnpj' => '00.000.000/000-00',
                'ddd' => '91',
                'tel' => '98181-9900'
            ],
            2 => [
                'nome' => 'Fornecedor 3',
                'status' => 'S',
                'cnpj' => '10.000.000/000-00',
                'ddd' => '34',
                'tel' => '98176-8888'
            ]
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
