<?php

namespace App\Http\Controllers;

use DB,Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\sendBienvenida;
//models
use App\User;
use App\Models\{Perfil, Area};


class UserController extends Controller
{
    public function  __construct() {

        $this->middleware('auth');
        // $this->middleware('is_administrador');
    }

    public function index(){
        $users = User::all();

        // datos para llenar los select
        $perfiles=Perfil::orderBy('id','asc')
            ->select(\DB::raw("CONCAT(id,'. ',nombre) AS nombre"), 'id')
            ->pluck('nombre','id');
        // dd($perfiles);

        $areas=Area::orderBy('id','asc')
            ->select(\DB::raw("CONCAT(id,'. ',nombre) AS nombre"), 'id')
            ->pluck('nombre','id');

        return view('usuarios.index')
            ->with('usuarios',$users)
            ->with('perfiles',$perfiles)
            ->with('areas',$areas);
    }


    // funtion para crear usuarios
    public function store(Request $request){

        $user=new User;
        $user->name= $request->nombre;
        $user->email= $request->email;
        $user->perfil_id= $request->perfil_id;
        $user->area_id= $request->area_id;
        $user->password = Str::random(30);
        // dd($user);
        if ($user->save()){
            $job = new SendBienvenida($user->email, $user->nombre, Auth::user()->id, $user->id);
            dispatch($job);
            return redirect()->back();
        }else{
            return 'No se guardo';
        }
    }


    public function verify($token){
        if (User::where('password', $token)->exists()) {
            $user=User::where('password', $token)->first();
            if (!$user->email_verified_at) {
                return view('auth.verificar')->with('token', $token);
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function verificar(Request $request){
        if ($request->contrasena == $request->confirmar) {
            if (strlen($request->contrasena)>=8) {
                if (User::where('password', $request->token)->exists()) {
                    $user=User::where('password', $request->token)->first();
                    $user->email_verified_at=Carbon::now();
                    $user->password=bcrypt($request->contrasena);

                    $user->save();

                    return redirect()->route('login')
                    ->with('message_success', 'Usuario verificado correctamente.');
                }else{
                    return redirect()
                    ->back()
                    ->with('message_danger', 'Token no valido.');
                }
            }else{
                return redirect()
                ->back()
                ->with('message_warning', 'La contraseña debe tener al menos 8 caracteres.');
            }
        }else{
            return redirect()->back()
            ->with('message_danger', 'La contraseña de verificación no coincide.');
        }
    }

}
