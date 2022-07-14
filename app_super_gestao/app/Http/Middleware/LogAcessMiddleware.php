<?php

namespace App\Http\Middleware;

use App\LogAcesso;
use Closure;

class LogAcessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request - Manipular

        // return $next($request);
        //response - Manipular
        // dd($request);
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log'=> "IP $ip requisitou a rorta $rota"]);
        // return Response($ip);

        $resposta = $next($request);
        $resposta->setStatusCode(201, 'O status da resposata e o texto da resposta foram modificados!!');
        // dd($resposta);
        return $resposta;
    }
}

