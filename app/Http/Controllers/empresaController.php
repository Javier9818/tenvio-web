<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class empresaController extends Controller
{

    public function setEmpresa(Request $request){
        $empresa = Empresa::create([
            "ruc" => $request->ruc,
            "nombre" => $request->nombre,
            "descripcion" => $request->descripcion,
            "telefono" => $request->telefono,
            "celular" => $request->celular,
            "direccion" => $request->direccion,
            "distrito" => $request->distrito,
            "categoria_id" => $request->categoria,
            "ciudad" => $request->ciudad,
        ]);

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
        $empresa->distrito = $request->distrito;
        $empresa->categoria_id = $request->categoria;
        $empresa->ciudad = $request->ciudad;

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
        $empresa = DB::select('select e.*, c.descripcion as categoriaName, c.id as categoria from empresas e
                                inner join categorias c on e.categoria_id = c.id
                                where e.id = ?', [$idempresa]);
        return view('admin.inicio', ["empresa" => $empresa[0]]);
    }

}
