<?php

namespace App\Http\Controllers;

use App\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $titulo,string $cuerpo, int $persona_id){

       
    }

    /**
     * Show the form for creating a new resource.
     *&
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        

        $newinfo = new Publicacion;
        $newinfo->titulo = $request->titulo;
        $newinfo->cuerpo = $request->cuerpo;
        if($request->hasFile('file')){
            $extension = $request->file('file')->extension();
            if($extension == 'png'||  $extension == 'jpeg' || $extension == 'jpg'){
                $path = Storage::disk('public')->putFile('img',$request->file);
                $newinfo->imagen = $path;
            }else {
                return response()->json(['Error'=>'Extension desconocida'],400);
            }
        }else{
            $newinfo->imagen = "";
        }
        $email= $request->user()->email;
        $id= DB::table('users')->select('id')->where('email', '=', $email)->first();
        $newinfo->user_id = $id->id;

        $newinfo->save();
        return response()->json('Finalizado', 200);
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
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion $publicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion $publicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacion $publicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion $publicacion)
    {
        //
    }
}
