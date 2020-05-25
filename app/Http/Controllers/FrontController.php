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
      default:
        # code...
        break;
    }
  }
  public function ListEmpresas( Request $request){
    $empresas =DB::table('empresas')
      //->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')
      ->select('id','nombre','descripcion','foto')
      ->where('nombre','=',$request->get('search'))
      ->get();
      // $empresas = DB::select('select e.*, c.descripcion as categoriaName from empresas e
      // inner join categorias c on e.categoria_id = c.id
      // where e.nombre = '+$request->get('search'));
      //var_dump($request->get('search'));
      //var_dump($empresas);
       return view('front.listEmpresa', ["empresas" => $empresas]);
  }
  public function Empresa($nombre){

      try {
        $empresa =DB::table('empresas')
        ->select('id','nombre','descripcion', 'ciudad_id')
        ->where('nombre','=',str_replace('-',' ',$nombre))
        ->get();
        return view('front.empresa')->with("data",$empresa);
      }catch (\Exception  $e) {
        // return [
        //   'Message'=> $e->getMessage(),
        //   'success'=>false
        // ];
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
          ['empresas.id', 'like', $request->get('id')],
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
