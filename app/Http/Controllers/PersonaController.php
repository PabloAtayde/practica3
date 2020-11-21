<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $newinfo = new Persona;

        $newinfo->nombre = $request->nombre;
        $newinfo->apellido = $request->apellido;
        $newinfo->edad = $request ->edad;
        $newinfo->sexo = $request->sexo;
        $newinfo->save();
        return response()->json('Finalizado', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona, int $id=0)
    {
        $persona = ($id==0)? Persona::all():Persona::find($id);
        return response()->json($persona, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function updatenombre(int $id,string $nombre)
    {
        $update= Persona::find($id);
        $update->nombre=$nombre;
        $update->save();
        return response()->json(["Update Finish"=>Persona::find($update->id)],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Persona::destroy($id);
        return response()->json('delete',200);

    }
}
