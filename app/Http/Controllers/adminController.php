<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\TipoNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function listarEmpresas(){
        $empresas = DB::select('select e.id, e.nombre, e.ruc, e.celular, c.distrito_id, c.nombre as ciudad
                                    from empresas e
                                    inner join ciudad c on e.ciudad_id = c.id
                                    where estado = ?
                                    order by estado DESC', ['ACTIVO']);
        $tiponegocios = TipoNegocio::all();
        return view('superadmin.empresas.mantenedor', ["empresas" => $empresas, "tiponegocios" => $tiponegocios]);
    }

    public function listarSolicitudes(){
        $empresas = DB::select('select e.*, e.ciudad_id as distrito_id,
                                    GROUP_CONCAT(ce.categoria_id) as categorias,
                                    GROUP_CONCAT(ca.descripcion) as categoriasdes,
                                    tn.id as tiponegocio,
                                    tn.descripcion as tiponegociodes
                                    from empresas e
                                    inner join categoria_empresa ce on ce.empresa_id = e.id
                                    inner join categorias ca on ca.id = ce.categoria_id
                                    inner join tipo_negocio tn on tn.id = ca.tipo_negocio_id
                                    where estado = ?
                                    group by e.id', ['SOLICITADO']);
        $tiponegocios = TipoNegocio::all();
        $categorias = DB::table('categorias')->selectRaw('id as value, descripcion as text, tipo_negocio_id as tiponegocio')->get();
        return view('superadmin.empresas.solicitudes', ["empresas" => $empresas, "tiponegocios" => $tiponegocios, "categorias" => $categorias]);
    }

    public function verEmpresa($idempresa){
        session(['empresa' => $idempresa]);
        // Session::put('empresa', $idempresa);
        return redirect('/intranet');
    }
    public function tipoNegocio()
    {
        return view('superadmin.empresas.tipoNegocios', [ "tiponegocios" => TipoNegocio::all()]);
    }

    public function funciones($tipo, Request $request)
    {
        switch ($tipo) {
            case 'TP_Save':
                return TipoNegocio::_Save($request);
                break;
            case 'TP_UDP':
                return TipoNegocio::_Update($request);
                break;
            case 'TP_DELETE':
                return TipoNegocio::_Delete($request);
                break; 
            case 'CT_Save':
                return Categoria::_Save($request);
                break;
            case 'CT_UDP':
                return Categoria::_Update($request);
                break;
            case 'CT_DELETE':
                return Categoria::_Delete($request);
                break; 
            case 'CT_CATEGORIES':
                return Categoria::_GET($request);
                break; 
            default:
                # code...
                break;
        }
    }

    public  function TP_Save($request)
    {       
        return TipoNegocio::_Save($request);
    }
    public  function TP_UDP($request)
    {
        return TipoNegocio::_Update($request);
    }
    public  function TP_DELETE($request)
    {
        return TipoNegocio::_Delete($request);
    }
}
