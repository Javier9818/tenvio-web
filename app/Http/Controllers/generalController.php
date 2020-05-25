<?php

namespace App\Http\Controllers;

use App\Ciudad;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class generalController extends Controller
{
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

    public function categoriasEmpresa(){
        $categorias = DB::select('select id as value, descripcion as text from categorias');
        return response()->json(["categorias" => $categorias], 200);
    }

    public function cargosEmpleado(){
        $roles = DB::select('select id as value, descripcion as text from cargos');
        return response()->json(["cargos" => $roles], 200);
    }

    public function vistaEmpleados(){
        return view('admin.negocio.empleados', ["empresa" => Session::get('empresa')]);
    }

    public function vistaNuevoEmpleado(){
        return view('admin.negocio.crearEmpleado', ["empresa" => Session::get('empresa')]);
    }

    public function vistaConfiguraciones(){
        return view('admin.config', ["empresa" => Session::get('empresa')]);
    }

    public function ciudades($ditritoId){
        $ciudades = Ciudad::where('distrito_id', $ditritoId)->get();
        return response()->json(["ciudades" => $ciudades], 200);
    }
}
