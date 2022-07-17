<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {
/*        echo $metodo_autenticacao . ' - ' . $perfil . '<br>';
        if ($metodo_autenticacao == 'padrao') {
            echo 'verificar o usuário e senha no banco <br>';
        }
        if ($metodo_autenticacao == 'ldap') {
            echo 'verificar se o usuário e senha no AD <br>';
        }
        if (false) {
            return $next($request);
        } else {
            return Response('Acesso negado! Rota existe autenticação');
        }*/
        session_start();
        if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);
        }else{
            return redirect()->route('site.login', ['erro'=> 2]);
        }
    }
}
