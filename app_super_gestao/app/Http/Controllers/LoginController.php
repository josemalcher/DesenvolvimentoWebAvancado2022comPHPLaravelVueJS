<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Login do Usuário';

        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário e/ou senha não existe';
        }

        return view('site.login', ['titulo'=> $titulo, 'erro'=>$erro]);
    }

    public function autenticar(Request $request)
    {
        // regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];
        // as mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo email é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        // recuperando dados do form
        $email = $request->get('usuario');
        $password = $request->get('senha');

        $user = new User();

        $usuario = $user
            ->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();
        if (isset($usuario->name)) {
            echo 'Usuário Existe';
        } else {
            return redirect()->route('site.login', ['erro'=> 1]);
        }
        /*        echo '<pre>';
                print_r($usuario);
                echo '</pre>';*/
    }
}
