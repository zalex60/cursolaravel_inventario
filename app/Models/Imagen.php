<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $filleables = ['token','articulo_id','usuario_id'];

    public function articulo(){
        return $this->belongsTo('App\Models\articulo','articulo_id');
    }

    public function usuario(){
        return $this->belongsTo('App\User','usuario_id');
    }
}
