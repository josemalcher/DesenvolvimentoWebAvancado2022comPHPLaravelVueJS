<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);

        if ($token) {
            return response()->json([
                'token' => $token,
            ], 200);
        }else{
            return response()->json([
                'erro' => 'usuário ou sernha invalido!'
            ], 403);
            // 403 forbidden -> proibido - login invalido
            // 401 Unauthorized -> não autorizado
        }
    }

    public function logout()
    {
        return 'logaut';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return 'me';
    }
}
