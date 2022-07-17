<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $titulo = 'Login do Usuário';

        return view('site.login', compact('titulo'));
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
        }else{
            echo "Usuário NÃO existe";
        }
/*        echo '<pre>';
        print_r($usuario);
        echo '</pre>';*/
    }
}
