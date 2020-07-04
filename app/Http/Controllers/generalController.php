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

    public function vistaEmpleados(){
        return view('admin.negocio.empleados', ["empresa" => session('empresa')]);
    }

    public function vistaNuevoEmpleado(){
        return view('admin.negocio.crearEmpleado', ["empresa" => session('empresa')]);
    }

    public function vistaConfiguraciones(){
        return view('admin.config', ["empresa" => session('empresa')]);
    }

    public function vistaUbicacion(){
        $empresa = Empresa::find(session('empresa'));
        return view('admin.ubicacion', ["empresa" => $empresa]);
    }

    public function vistaTransporte(){
        $pedidos = DB::table('pedidos')
                ->join("pedidos_users", "pedidos_users.pedidos_id", "pedidos.id")
                ->join("asignacion", "asignacion.id", "pedidos_users.asignacion_id")
                ->join("users", "users.id", "=", "pedidos.user_id")
                ->join("personas", "personas.id", "=", "users.persona_id")
                ->join("detalle_pedidos", "detalle_pedidos.pedido_id", "=", "pedidos.id")
                ->selectRaw('pedidos.id, CONCAT(personas.appaterno ," ", personas.apmaterno ," ",personas.nombres) as cliente,
                pedidos.direccion, pedidos.monto, pedidos.latitud, pedidos.longitud, personas.celular')
                ->whereRaw("asignacion.user_id= ? and pedidos.estado ='ENVIANDO'", [Auth::id()])
                ->groupBy("pedidos.id")
                ->get();
        return view('admin.transporte.transporte', ["empresa" => session('empresa'), "pedidosAsignados" => $pedidos]);
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
        return view('landing_pages.tenvio_promocional', ["tiponegocios" => $tiponegocios]);
    }
}
