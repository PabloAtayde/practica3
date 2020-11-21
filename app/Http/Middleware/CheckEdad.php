<?php

namespace App\Http\Middleware;

use Closure;

class CheckEdad
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
        if ($request->edad < 18){
            return abort(403, "No eres mayor de edad");
        }
        return $next($request);
    }
}
