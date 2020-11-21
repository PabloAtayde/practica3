<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RickMortyController extends Controller
{
    public function consultarPersonaje(Request $request){
        $response = Http::get('https://rickandmortyapi.com/api/character/2'.$request->name);
        return $response->json();
    }
    public function consultarUbicacion(Request $request){
        $response = Http::get('https://rickandmortyapi.com/api/location/3'.$request->name);
        return $response->json();
    }
    public function consultarEpisodio(Request $request){
        $response = Http::get('https://rickandmortyapi.com/api/episode/28'.$request->name);
        return $response->json();
    }
}
