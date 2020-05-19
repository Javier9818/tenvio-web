<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{

    public function listarEmpresas(){
        $empresas = DB::select('select * from empresas order by estado DESC', []);
        return view('superadmin.empresas.mantenedor', ["empresas" => $empresas]);
    }

    public function verEmpresa($idempresa){
        Session::put('empresa', $idempresa);
        return redirect('/intranet');
    }

}
