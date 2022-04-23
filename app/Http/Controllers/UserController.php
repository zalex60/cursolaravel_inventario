<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Models\{Perfil,Area};
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::all();

        //Datos para llenar los select
        $perfiles=Perfil::orderBy('id','asc')
        ->select(\DB::raw("CONCAT(id,'. ',nombre) AS dato"), 'id')
        ->pluck('dato', 'id');

        $areas=Area::orderBy('id','asc')
        ->select(\DB::raw("CONCAT(id,'. ',nombre) AS dato"), 'id')
        ->pluck('dato', 'id');

        //Con with mando los datos a las vistas
        return view('usuarios.index')
        ->with('usuarios',$users)
        ->with('perfiles',$perfiles)
        ->with('areas',$areas);
    }

    //funcion para crear usuarios
    public function store(Request $request){
        $user = new User;
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->perfil_id = $request->perfil_id;
        $user->area_id = $request->area_id;
        
        if ($user->save()) {
            return 'si se guardo';
        }else{
            return 'No se guardo';
        }
    }
}
