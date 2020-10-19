<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Ciudad;
use App\Empresa;
use App\TipoNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function viewBussinessNear(){
        
        $tiponegocios = TipoNegocio::all();
        $categorias = Categoria::all();
        return view('front.components.bussinnes-near-map', ["tiponegocios" => $tiponegocios, "categorias" => $categorias]);
    }

    public function bussinessNear($lat, $lng){
        $empresas = Empresa::listNearCompanies($lat, $lng, 20);
        return response()->json(["empresas" => $empresas], 200);
    }

    public function roles(){
        $roles = DB::select('select id as value, descripcion as text from permisos where descripcion != "User"');
        return response()->json(["roles" => $roles], 200);
    }

    public function validateUsername($username){
        $user = DB::select('select * from users where username = ?', [$username]);
        if(count($user) > 0 )
            return response()->json(["message" => true]);
        else
            return response()->json(["message" => false]);
    }

    public function validateEmail($email){
        $user = DB::select('select * from users where email = ?', [$email]);
        if(count($user) > 0 )
            return response()->json(["message" => true]);
        else
            return response()->json(["message" => false]);
    }

    public function categoriasEmpresa($tiponegocio){
        $categorias = DB::table('categorias')
        ->selectRaw('id as value, descripcion as text')
        ->where('tipo_negocio_id', '=', $tiponegocio)->get();
        return response()->json(["categorias" => $categorias], 200);
    }

    public function tipoNegociosEmpresa(){
        $tiponegocios = TipoNegocio::all();
        return response()->json(["tiponegocios" => $tiponegocios]);
    }

    public function cargosEmpleado(){
        $roles = DB::select('select id as value, descripcion as text from cargos');
        return response()->json(["cargos" => $roles], 200);
    }

    public function ciudades($ditritoId){
        $ciudades = Ciudad::where('distrito_id', $ditritoId)->get();
        return response()->json(["ciudades" => $ciudades], 200);
    }

    public function notification($empresa){
        $ordenesPendientes = DB::table('pedidos')->where("estado","=","PENDIENTE")->where("empresa_id","=",$empresa)->count();
        $ordenesAceptadas = DB::table('pedidos')->where("estado","=","ACEPTADO")->where("empresa_id","=",$empresa)->count();
        $ordenesEnviadas = DB::table('pedidos')->where("estado","=","ENVIANDO")->where("empresa_id","=",$empresa)->count();

        return response()->json(["ordenesPendientes" => $ordenesPendientes, "ordenesAceptadas" => $ordenesAceptadas, "ordenesEnviadas" => $ordenesEnviadas], 200);
    }

    public function vistaPromocional(){
        $tiponegocios = TipoNegocio::all();
        return view('front.quienes-somos', ["tiponegocios" => $tiponegocios]);
    }
}
