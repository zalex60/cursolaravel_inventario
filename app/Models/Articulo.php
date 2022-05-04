<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulos';
    protected $filleables = ['nombre','fecha_adquisicion','serie','descripcion','cantidad','costo','estado','folio','marca_id','area_id'];

    public function marca(){
        return $this->belongsTo('App\Models\Marca','marca_id'); 
    }

    public function area(){
        return $this->belongsTo('App\Models\Area','area_id'); 
    }

    public function imagen(){
        return $this->hasOne('App\Models\Imagen','articulo_id');
    }
}
