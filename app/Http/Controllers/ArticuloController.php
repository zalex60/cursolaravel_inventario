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
        $path_base = $token.'/'.$token.'.'.$formato;
        try{
            $contents = \File::get($request->file('imagen'));
            if(!Storage::disk('public')->exists($path_base)){
                Storage::disk('public')->put($path_base,$contents);
                if(!Storage::disk('public')->exists($path_base)){
                    \Session::flash('message_danger', ['¡Error No se Guardo el anexo!']);
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
            $imagen->save();
            \Session::flash('message_success', '¡Error! El articulo se guardó correctamente.');
            return redirect()->back();
        }else{
            \Session::flash('message_danger', '¡Error! El articulo no se guardo.');
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $articulo = Articulo::find($request->articulo_id);
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
            \Session::flash('message_success', '¡Se edito correctamente el articulo!');
            return redirect()->back();
        }else{
            \Session::flash('message_danger', '¡Error. No se editó! No se lograron guardar los cambios del articulo.');
            return redirect()->back();
        } 
    }

    public function destroy($id){
        if (Articulo::where('id',$id)->exists()) {
            $articulo=Articulo::find($id);
            if ($articulo->delete()) {
                return ['status'=>1,'message'=>'Se eliminó correctamente'];
            }else{
                return ['status'=>0,'message'=>'No se elimino el usuario'];
            }
        }else{
            return ['status'=>0,'message'=>'No se elimino el usuario'];
        }
    }
}
