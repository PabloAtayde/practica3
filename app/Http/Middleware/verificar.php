<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class verificar
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
        $usuario = User::where('email', $request->email)->first();
        if($usuario->email_verified_at == NULL){

            abort(403, "Nesecitas verificar tu correo");
        }
        return $next($request);
    }
}
