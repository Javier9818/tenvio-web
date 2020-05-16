<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class superAdminController extends Controller
{
    public function listarEmpresas(){
        $empresas = DB::select('select * from empresas order by estado DESC', []);
        return view('superadmin.empresas.mantenedor', ["empresas" => $empresas]);
    }
}
