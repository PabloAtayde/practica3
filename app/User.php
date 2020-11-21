<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    public function publicaciones(){
        return $this->hasMany('App\Publicacion');

    }
    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }
    public function personas(){
        return $this->belongsTo('App\Persona');
    }
}