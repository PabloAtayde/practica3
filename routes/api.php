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