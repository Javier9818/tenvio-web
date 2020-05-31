<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use App\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmpresaController extends Controller
{

    public function setEmpresa(Request $request){

        $ciudad = ($request->ciudad == null)? (Ciudad::create(["nombre" => $request->ciudadCreate, "distrito_id" => $request->distrito]))->id : $request->ciudad;
        $usernameEmpresa = Empresa::crearNombreUnico(str_replace(' ', '', strtolower($request->nombre)));

        $empresa = Empresa::create([
            "ruc" => $request->ruc,
            "nombre" => $request->nombre,
            "descripcion" => $request->descripcion,
            "telefono" => $request->telefono,
            "celular" => $request->celular,
            "direccion" => $request->direccion,
            "categoria_id" => $request->categoria,
            "ciudad_id" => $ciudad,
            "nombre_unico" => $usernameEmpresa
        ]);

        DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id) values (?, ?)', [$empresa->id, 1]);
        DB::insert('insert into tipo_entrega_empresas(empresa_id, tipo_entrega_id) values (?, ?)', [$empresa->id, 2]);

        Contrato::create([
            "empresa_id" => $empresa->id,
            "estado" => 'PRUEBA'
        ]);

        return response()->json(["message" => "Registro exitoso"], 200);
    }

    public function updateEmpresa(Request $request, $empresa){
        $empresa = Empresa::find($empresa);
        $empresa->nombre = $request->nombre;
        $empresa->ruc =  $request->ruc;
        $empresa->descripcion = $request->descripcion;
        $empresa->telefono = $request->telefono;
        $empresa->celular = $request->celular;
        $empresa->direccion = $request->direccion;
        $empresa->categoria_id = $request->categoria;
        $empresa->ciudad_id = $request->ciudad_id;

        $empresa->save();
        return response()->json(["message" => "Actualización exitosa"], 200);
    }

    public function updateFoto(Request $request, $empresa){
        $empresa = Empresa::find($empresa);

        $image = substr($request->image, strpos($request->image, ',') + 1);
        $image = base64_decode($image);
        //return $image;

        if($empresa->foto != '') $res = Empresa::setImagen($image, $empresa->foto);
        else $res = Empresa::setImagen($image);

        if($res !== false){
            $empresa->foto = $res;
            $empresa->save();
            return response()->json(["message" => "Actualización exitosa", "foto" => $res], 200);
        }else{
            return response()->json(["message" => "Error en actualización"], 500);
        }

    }

    public function verEmpresa(){
        $idempresa = Session::get('empresa');
        // $permisos = Auth::user()->permisoUser;
        // return dd($permisos[5]->descripcion);
        $empresa = DB::select('select e.*, c.descripcion as categoriaName, c.id as categoria, ci.nombre as ciudad, ci.distrito_id as distrito
                                from empresas e
                                inner join categorias c on e.categoria_id = c.id
                                inner join ciudad ci on ci.id = e.ciudad_id
                                where e.id = ?', [$idempresa]);
        $ciudades = Ciudad::where('distrito_id', $empresa[0]->distrito)->get();
        return view('admin.inicio', ["empresa" => $empresa[0], "ciudades" => $ciudades]);
    }

    public function listarEmpresas(){

        $empresas = Empresa::all();

        return view('front.listEmpresa',compact('empresas'));
    }

    public function tiposEntrega($empresa){
        $tipos = DB::select('select * from tipo_entrega_empresas te
                            inner join tipo_entregas t on te.tipo_entrega_id = t.id
                            where te.empresa_id = ?', [$empresa]);
        return response()->json(["tipos" => $tipos], 200);
    }

    public function updateTipoEntrega(Request $request){
        DB::update('update tipo_entrega_empresas set estado = ? where tipo_entrega_id = ? and empresa_id = ?', [$request->estado, $request->tipo_entrega_id, $request->empresa]);
    }

    public function nombreUnico($idempresa){
        $empresa = Empresa::find($idempresa);
        return response()->json(["nombreUnico" => $empresa->nombre_unico]);
    }

    public function updateNombreUnico(Request $request){
        $empresa = Empresa::find($request->empresa);
        $empresa->nombre_unico = $request->nombreUnico;
        $empresa->save();
        return response()->json(["Message" => 'Actualización exitosa']);
    }

    public function validaNombreUnico(Request $request){
        $empresas = DB::table('empresas')->where('nombre_unico','=',$request->nombreUnico)->get();
        return (count($empresas)>0) ? response()->json(["message" => true]) : response()->json(["message"=>false]);
    }

}
