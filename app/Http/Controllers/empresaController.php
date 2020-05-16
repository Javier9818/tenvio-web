<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use Illuminate\Http\Request;

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
}
