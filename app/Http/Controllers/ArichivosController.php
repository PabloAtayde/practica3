<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ArichivosController extends Controller
{
    public function guardarArchivo(Request $request){
        if($request->hasFile('file')){
           // $extension = $request->file('file');  //->extension();
             $path = Storage::disk('public')->putFile('archivos/img',$request->file); 
        }
            return response()->json(["Respuesta"=>$path],201);
    }
}

