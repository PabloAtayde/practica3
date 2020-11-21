<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('usuario/imagen', 'ArichivosController@guardarArchivo');
Route::get('personas/{id?}','PersonaController@show')->where('id','[0-9]+')->name('ruta');
Route::post('persona/registro','PersonaController@index')->middleware('check.edad');
Route::put('persona/updatenombre/{id}/{nombre}','PersonaController@updatenombre')->where(['id','[0-9]+',
'nombre','[A-z]+']);
Route::delete('persona/delete/{id}','PersonaController@destroy');

Route::post('registrar/usuario', 'UserController@registro');
Route::get('verificar/{email}','UserController@verificar');
Route::post('login/usuario', 'UserController@login')->middleware('verificar');
Route::delete('logout/usuario', 'UserController@logOut');
Route::get('index/usuario', "UserController@index");

Route::middleware('auth:sanctum')->group(function () {
Route::post('publicacion/registro','PublicacionController@create');//->middleware('verificar.rol');
Route::post('comentario/registro','ComentarioController@create');
});
Route::get('comentarios/{id?}','ComentarioController@show')->where('id','[0-9]+')->name('rutacomentarios');
Route::put('comentarios/updatetitulo/{id}/{titulo}','ComentarioController@updatetitulo')->where(['id','[0-9]+',
'titulo','[A-z]+']);
Route::delete('comentarios/delete/{id}','ComentarioController@destroy');
Route::get('persona/{persona_id}/comentario/{id?}','ComentarioController@consulPerson')
->where( ['id','[0-9]+','persona_id','[0-9]+']);
Route::get('publicacion/{publicacion_id}/comentario/{id?}','ComentarioController@comentPubli')
->where( ['id','[0-9]+','publicacion_id','[0-9]+']);
Route::get('persona/{persona_id}/publicacion/{publicacion_id}/comentario/{id?}', 'ComentarioController@personPubliComent')->where( ['publicacion_id','[0-9]+','id','[0-9]+','persona_id','[0-9]+']);
Route::get('comentario/publicacion/persona', 'ComentarioController@showalll');
Route::put('publicacion/updatetitulo/{id}/{titulo}','PublicacionController@updatetitulo')->where(['id','[0-9]+',
'titulo','[A-z]+']);
Route::get('publicacionshow/{id?}','PublicacionController@showme')->where('id','[0-9]+')->name('rutapublicaciones');
Route::get('/rickmorty/personaje','RickMortyController@consultarPersonaje');
Route::get('/rickmorty/ubicacion','RickMortyController@consultarUbicacion');
Route::get('/rickmorty/episodio','RickMortyController@consultarEpisodio');