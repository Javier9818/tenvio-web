<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return $this::TipoPedido($request);
        break;
      default:
        # code...
        break;
    }
  }
  public function TipoPedido(Request $request)
  {
    try {
      $where="";
     // dd($request->get('empresas')[0][0]);
      foreach ($request->get('empresas') as $key => $value) {        
        $where.='empresas.id='.$value['empresa'];
        if($key!=count($request->get('empresas'))-1)
          $where.=' and ';
      }
      return DB::table('empresas')
        ->join('tipo_entrega_empresas', 'tipo_entrega_empresas.empresa_id', '=', 'empresas.id')
        ->join('tipo_entregas', 'tipo_entregas.id', '=', 'tipo_entrega_empresas.tipo_entrega_id')         
        ->selectRaw('tipo_entregas.id as value, tipo_entregas.nombre as text, empresas.id')  
        ->whereRaw($where)       
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
    $log='';
    
    try {
      foreach ($request->get('empresas') as $key => $empresa) {
        $log='Pedido';
        $idPedido = DB::table('pedidos')->insertGetId(
          [
            'empresa_id' => $empresa['empresa'], 
            'estado' => 'ACTIVO', 
            'comentario'=>' ', 
            'latitud'=>$empresa['lat'],
            'longitud'=>$empresa['lng'],
            'meta_latitud'=>$empresa['lat'], 
            'meta_longitud'=>$empresa['lng'], 
            'user_id'=>Auth::user()->persona_id, 
            'tipo_id'=>$empresa['tipoEntrega'],
            'direccion'=>$empresa['direccion']
          ]
        );
         
        $log='a';
        if(($idPedido<=0))
          return 2;
        foreach ($request->get('productos') as $key => $producto) {
          if ($producto['empresa']==$empresa['empresa']) {
          DB::table('detalle_pedidos')->insert(
              [
                'producto_id'=>$producto['id'],
                'pedido_id'=>$idPedido,
                'cantidad'=>$producto['cant'],
                'precio_unit'=>$producto['precio']
              ]
            );             
          }
        }      
      }
      return 1;
    } catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage().' '.$log,
        'success'=>false
      ];
   }
    
    
  }
  public function ListEmpresas( Request $request){
    $empresas =DB::table('empresas')
      ->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')
      ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
      // ->where('empresas.nombre','like','%'.$request->get('search').'%')
      ->whereRaw('MATCH(empresas.nombre,empresas.celular,empresas.telefono ) AGAINST (?)', ["'".$request->get('search')."'"])
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
          ['productos.usuario_puede_ver', '=',1],
          ['productos.estado', '=',1],
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
        ['productos.usuario_puede_ver', '=',1],
        ['productos.estado', '=',1],
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
