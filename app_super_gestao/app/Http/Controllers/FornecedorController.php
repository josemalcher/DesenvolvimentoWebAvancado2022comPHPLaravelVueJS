<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
//    public function index()
//    {
//        //$fornecedores = ['Fornecedor 1'];
//        $fornecedores = [
//            0 => [
//                'nome' => 'Fornecedor 1',
//                'status' => 'N',
//                'cnpj' => '',
//                'ddd' => '11',
//                'telefone' => '0000-0000'
//            ],
//            1 => [
//                'nome' => 'Fornecedor 2',
//                'status' => 'N',
//                'cnpj' => null,
//                'ddd' => '91',
//                'telefone' => '0000-0000'
//            ],
//            2 => [
//                'nome' => 'Fornecedor 3',
//                'status' => 'N',
//                'cnpj' => null,
//                'ddd' => '32',
//                'telefone' => '0000-0000'
//            ]
//        ];
//        return view('app.fornecedor.index', compact('fornecedores'));
//    }
    public function index()
    {
        return view('app.fornecedor');
    }
}
