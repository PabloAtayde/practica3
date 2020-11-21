<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function registro(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $usuario = new User();
        $usuario->nickname = $request->nickname;
        $usuario->email = $request->email;
        $usuario->imagen = $request->imagen;
        $usuario->password =Hash::make($request->password);
        $usuario->persona_id = $request->persona_id;
        $usuario->rol = $request->rol;

        if($usuario->save()){
            UserController::sendEmail($request);
            return response()->json($usuario,201);
        }
        return abort(400,"Imposible registrarse");
    }
    public static function sendEmail(request $request){

        $data = array(
             'email' => $request->email
         );
 
         Mail::send('bienvenida', $data, function ($message) use ($request){
             $message->from('19170130@uttcampus.edu.mx', 'API');
             $message->to($request->email)->subject('Demostracion');
 
         });
 
             return "Tu email se envio satisfactoriamente";
 
     }
     public function verificar(String $email){
        $usuario = User::where('email', $email)->first();

        if($usuario){
            $usuario->email_verified_at = NOW();
            $usuario->save();
            return redirect('http://127.0.0.1:8000/');
        }
        return abort('Invalido', 401);


    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $usuario = User::where('email', $request->email)->first();
        
        if(! $usuario || ! Hash::check($request->password, $usuario->password)){
            throw ValidateException::withMessages([
                'email' => ['Datos erróneos'],
            ]);
        }

        if($usuario->rol == 'Administrador'){
            $token = $usuario->createToken($request->email,['Admin'])->plainTextToken;
        }
        else if($usuario->rol == 'Usuario'){
            $token = $usuario->createToken($request->email,['Usuario'])->plainTextToken;
        }
        
        return response()->json(["token"=>$token],201);
    }
    public function logOut(Request $request){
        return response()->json(['usuarios'=>$request->user()->tokens()->delete()],200);
    }
    public function index(Request $request){
        
        if($request->user()->tokenCan('Usuario')){
            return response()->json(["Scope Invalido"],401);
            
        }
        elseif($request->user()->tokenCan('Admin')){
           return response()->json(["Administrador"=>$request->user()],200);
           
       }
   
        
    }
}
