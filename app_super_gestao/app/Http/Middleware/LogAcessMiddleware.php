<?php

namespace App\Http\Middleware;

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
        return Response('Middleware e parei nele');
    }
}
