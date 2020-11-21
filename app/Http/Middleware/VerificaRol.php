<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Closure;

class VerificaRol
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
        {
    
            if($request->user()->tokenCan('Administrador')){
                $usuario = $request->user()->email;
                $url = $request->url();
                VerificaRol::enviarCorreo($usuario,$url);
                return abort(401);
            }
            return $next($request);
        }
        
    }
    public static function enviarCorreo($usuario, $url){
        $correosAdmin = DB::table('users')->select('email')->where('rol','=','Usuario')->get();
        foreach ($correosAdmin as $admin) {
            $data = array(
            'usuario' => $usuario,
            'url' => $url
            );
            Mail::send('admin', $data, function ($message) use ($admin){
                $message->from('19170130@uttcampus.edu.mx', 'Infiltracion');
                $message->to($admin->email)->subject('Infiltracion');
            });
        }

    }
}
