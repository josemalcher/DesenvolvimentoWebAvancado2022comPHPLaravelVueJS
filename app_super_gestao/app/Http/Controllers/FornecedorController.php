<?php

namespace App\Http\Controllers;

use App\Fornecedor;
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
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor:: with('produtos')
            ->where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            //->get();
            ->paginate(10);
        // dd($fornecedores);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request'=> $request->all()]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        // INCLUSAÔ
        if ($request->input('_token') != '' && $request->input('id') == '') {
            //validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo NOME deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo NOME deve ter no maximo 40 caracteres',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo UF deve ter no maximo 2 caracteres',
                'email.email' => 'Email não é válido',
            ];
            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            // dados retorno
            $msg = 'Cadastro Realizado com sucesso';
        }
        // EDIÇÂO
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());
            if ($update) {
                $msg = 'update realizado com sucesso';
            }else{
                $msg = 'ERRO AO ATUALIZAR';
            }
            return redirect()->route('app.fornecedor.editar', ['id'=> $request->input('id'), 'msg' => $msg]);
        }


        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor,  'msg' => $msg]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
