<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    public function users(){
        return $this->belongsTo('App\User');
    }
    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }
}
