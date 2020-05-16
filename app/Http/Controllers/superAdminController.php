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

    public function verEmpresa($idempresa){
        $empresa = DB::select('select e.*, c.descripcion as categoria from empresas e
                                inner join categorias c on e.categoria_id = c.id
                                where e.id = ?', [$idempresa]);
        return view('admin.inicio', ["empresa" => $empresa[0]]);
    }
}
