<?php
namespace App\Http\Controllers\Empresa;

use App\Categoria;
use App\Ciudad;
use App\Empresa;
use App\Http\Controllers\Controller;
use App\Pedidos;
use App\TipoNegocio;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    
    public function __construct(){}


    public function showCompany(){
        $empresa = Empresa::getCompany(session('empresa'));
        $ciudades = Ciudad::where('distrito_id', $empresa->distrito)->get();
        $categorias = Categoria::getCategoryByTypeBussiness($empresa->tiponegocio);
        $tiponegocios = TipoNegocio::all();
        return view('admin.inicio', ["empresa" => $empresa, "ciudades" => $ciudades, "tiponegocios" => $tiponegocios, "categorias" => $categorias]);
    }

    public function showConfigurations(){
        return view('admin.config', ["empresa" => session('empresa')]);
    }

    public function showLocation(){
        $empresa = Empresa::find(session('empresa'));
        return view('admin.ubicacion', ["empresa" => $empresa]);
    }

    public function showTransport(){
        $pedidos = Pedidos::getOrdersByEmployeeId(Auth::id());
        return view('admin.transporte.transporte', ["empresa" => session('empresa'), "pedidosAsignados" => $pedidos]);
    }
    
}