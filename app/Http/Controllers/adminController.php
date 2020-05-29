<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function listarEmpresas(){
        $empresas = DB::select('select e.id, e.nombre, e.ruc, e.celular, c.distrito_id, c.nombre as ciudad  from empresas e inner join ciudad c on e.ciudad_id = c.id order by estado DESC', []);
        return view('superadmin.empresas.mantenedor', ["empresas" => $empresas]);
    }

    public function verEmpresa($idempresa){
        Session::put('empresa', $idempresa);
        return redirect('/intranet');
    }

}
