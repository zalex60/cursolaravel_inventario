<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table='perfiles';
    protected $fillables = ['nombre'];

    public function usuarios(){
        return $this->hasMany('App\User','perfil_id');
    }
}
