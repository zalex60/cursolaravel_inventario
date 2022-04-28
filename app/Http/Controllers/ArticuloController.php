<?php

namespace App\Http\Controllers;

use Str,Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{Articulo,Area,Marca,Imagen};

class ArticuloController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $articulos = Articulo::all();
        $marcas=Marca::orderBy('id','asc')
        ->select(\DB::raw("CONCAT(id,'. ',nombre) AS dato"), 'id')
        ->pluck('dato', 'id');
        $areas=Area::orderBy('id','asc')
        ->select(\DB::raw("CONCAT(id,'. ',nombre) AS dato"), 'id')
        ->pluck('dato', 'id');
        return view('articulos.index')->with('articulos',$articulos)->with('areas',$areas)->with('marcas',$marcas);
    }

    public function store(Request $request){
        $token = Str::random(5);
        $formato = '.'.explode('/',$request->file('imagen')->getMimeType())[1];
        $path_base = $token.'/'.$token.$formato = '.'.explode('/',$request->file('imagen')->getMimeType())[1];
        try{
            $contents = \File::get($request->file('imagen'));

            if(!Storage::disk('public')->exists($path_base)){
                Storage::disk('public')->put($path_base,$contents);
                if(!Storage::disk('public')->exists($path_base)){
                    \Session::flash('message_danger', '¡Error No se Guardo el anexo!');
                    return redirect()->back();
                }
            }else{
                \Session::flash('message_danger', '¡Error. No se Guardó el anexo! Ya se encuentra un archvo con el mismo nombre en el servidor');
                return redirect()->back();
            }
        }catch(\Exception $e){
            \Session::flash('message_danger', '¡Error. No se Guardó la anexo!');
            return redirect()->back();
        }
        $articulo = new Articulo;
        $articulo->nombre = $request->nombre;
        $articulo->fecha_adquisicion = Carbon::now();
        $articulo->serie = $request->serie;
        $articulo->descripcion = $request->descripcion;
        $articulo->cantidad = $request->cantidad;
        $articulo->costo = $request->costo;
        $articulo->estado = $request->estado;
        $articulo->folio = $token;
        $articulo->marca_id = $request->marca_id;
        $articulo->area_id = $request->area_id;
        if ($articulo->save()) {
            $imagen = new Imagen;
            $imagen->token = $token;
            $imagen->type = $request->file('imagen')->getMimeType();
            $imagen->articulo_id = $articulo->id;
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
