<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
  public function Funciones($opcion,Request $request)
  {
    switch ($opcion) {
      case 'productos':
        return $this::productos($request);
        break;
      case 'categorias':
        return $this::categorias($request);
        break;
      case 'GeneraPedido':
        return $this::GeneraPedido($request);
        break;
      case 'TipoPedido':
        return $this::TipoPedido();
        break;
      default:
        # code...
        break;
    }
  }
  public function TipoPedido()
  {
    try {
      return DB::table('empresas')
        ->join('tipo_entregas_empresa', 'tipo_entregas_empresa.empresa_id', '=', 'empresas.id')
        ->join('tipo_entregas', 'tipo_entregas.id', '=', 'tipo_entregas_empresa.tipo_entregas_id')         
        ->selectRaw('tipo_entregas.id, tipo_entregas.nombre')         
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
    }
  }
  public function GeneraPedido( Request $request)
  {
    foreach ($request->get('empresas') as $key => $empresa) {
      $id = DB::table('pedidos')->insertGetId(
        ['empresa_id' => $empresa->id, 'estado' => 'ACTIVO', 'comentario'=>'', 'latitud'=>'', 'longitud'=>'', 'meta_latitud'=>'', 'meta_longitud'=>'', 'user_id'=>'', 'tipo_id'=>'']
      );

    }
    
  }
  public function ListEmpresas( Request $request){
    $empresas =DB::table('empresas')
      ->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')
      ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
      ->where('empresas.nombre','like','%'.$request->get('search').'%')
      ->get();
       return view('front.listEmpresa', ["empresas" => $empresas]);
  }
  public function Empresa($nombre){

      try {
        $empresa =DB::table('empresas')
        ->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')
        ->join('ciudad', 'ciudad.id', '=', 'empresas.ciudad_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria', 'ciudad.nombre as ciudad', 'ciudad.distrito_id')
        // ->where('empresas.nombre','=',str_replace('-',' ',$nombre))
        ->where('empresas.nombre_unico','=', $nombre)
        ->get();
        return view('front.empresa')->with("data",$empresa);
      }catch (\Exception  $e) {         
        return abort(404);
     }

  }
  public function productos(Request $request)
  {
    try {
      if($request->get('tipo')=='all'){
        return DB::table('empresas')
        ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
        ->select('productos.nombre', 'productos.descripcion','productos.precio','productos.foto', 'productos.id')
        ->where([
          ['empresas.id', '=', $request->get('id')],
        ])
        ->get();
      }
      return DB::table('empresas')
      ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
      ->join('categorias_menus', 'categorias_menus.id', '=', 'productos.categorias_menu_id')
      ->select('productos.nombre', 'productos.descripcion','productos.precio','productos.foto', 'productos.id')
      ->where([
        ['categorias_menus.id', '=', $request->get('tipo')],
        ['empresas.id', '=', $request->get('id')],
      ])
      ->get();

    } catch (\Exception  $e) {
       return [
         'Message'=> $e->getMessage(),
         'success'=>false
       ];
    }
  }
  public function categorias(Request $request)
  {
     try {
      return DB::table('empresas')
        ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
        ->join('categorias_menus', 'categorias_menus.id', '=', 'productos.categorias_menu_id')
        ->selectRaw(' DISTINCT categorias_menus.descripcion as text, categorias_menus.id as value')
        ->where('empresas.id','=',$request->get('id'))
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
}
