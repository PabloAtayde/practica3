<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        $nuevoComentario = new Comentario;
        $nuevoComentario ->cuerpo=$request->cuerpo;
        $nuevoComentario ->publicacion_id=$request->publicacion_id;
        $email= $request->user()->email;
        $id= DB::table('users')->select('id')->where('email', '=', $email)->first();
        $nuevoComentario->user_id = $id->id;
        $idUser = $id->id;
        $nuevoComentario ->save();
        if($nuevoComentario->save()){
            ComentarioController::enviarCorreoPublicacion($request->publicacion_id,$email,$request->cuerpo);
            ComentarioController::enviarEmail($idUser);
            return response()->json([
                                "comentario" => Comentario::find($nuevoComentario->id)
                                ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        //
    }
    public static function enviarEmail($idUser){
        $comentario = DB::table('users')->select('email')->where('id','=',$idUser)->first();
        $data = Array(
            'correo'=>$idUser,
        );
        Mail::send('nuevoComentario',$data, function($message) use ($comentario){
            $message->from('19170130@uttcampus.edu.mx'); 
            $message->to($comentario->email)->subject('Comentario Nuevo');
        });
        return "Tu correo se envio.";
    }
    public static function enviarCorreoPublicacion($publicacion, $usuario, $comentario){
        $infoPublicacion = DB::table('publicacions')->where('id','=',$publicacion)->first();
        $autor = DB::table('users')->select('email')->where('id','=',$infoPublicacion->user_id)->first();
        $data = array(
            'titulo' => $infoPublicacion->titulo,
            'cuerpo' => $infoPublicacion->cuerpo,
            'usuario' => $usuario,
            'comentario' => $comentario
            );
            Mail::send('notificacion', $data, function ($message) use ($autor){
                $message->from('19170130@uttcampus.edu.mx', 'Notificacion');
                $message->to($autor->email)->subject('Notificacion');
            });
    }
}
