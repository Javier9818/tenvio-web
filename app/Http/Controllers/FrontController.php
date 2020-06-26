<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empresa;
use App\Pedidos;
use App\Events\NewOrderEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
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
      case 'ListPedido':
        return $this::ListPedido($request);
        break;
      case 'encripta':
        return $this::encripta($request);
        break;
      case 'getPedido':
        return $this::getPedido($request);
        break;
      case 'CategoriasxNegocio':
        return $this::CategoriasxNegocio($request);
        break;
      case 'TipoNegocio':
        return $this::TipoNegocio();
        break;
      case 'Valida':
        return $this::Valida();
        break;
      default:
        # code...
        break;
    }
  }
  public function Valida()
  {    
     
    return (Auth::id()==null)? 0:1;
  }
  public function categoriasIndex()
  {
     try {
      return view(
        'front.index',
        ["data"=> DB::table('categorias')
        ->selectRaw(' categorias.descripcion as categoria')
        ->get()
        ]);
     }catch (\Exception  $e) {
      return view(
        'front.index',
        ["data"=> []
        ]);
   }
  }
  public function encripta($request)
	{
		return "/seguimiento/".Crypt::encrypt(json_encode(["id" => $request->id]));
	}
  public function seguimiento($cifrado)
	{
		try {
      $decrypted = Crypt::decrypt($cifrado);
      $decrypted = json_decode($decrypted);
      return view('front.seguimiento', ["data"=>$decrypted]);
    } catch ( \Throwable $th) {
      return abort(404);
    }
  }
  public function ListPedido($request)
  {
    if(Auth::id()==null)
      return 'Error';
    return DB::table('pedidos')
     ->join('empresas', 'pedidos.empresa_id', '=', 'empresas.id')
     ->join('detalle_pedidos as dp', 'dp.pedido_id', '=', 'pedidos.id')
     ->select('empresas.nombre as empresa','pedidos.estado as state','pedidos.id as pedido', 'pedidos.created_at as date'   
     )
     ->where('pedidos.user_id','=', Auth::user()->persona_id)
     ->orderBy('pedidos.created_at', 'desc')
     ->groupBy('pedidos.id')
     ->paginate(5,[],'',$request->get('page'));
  }
  public function getPedido($request)
  {
    try {
      return DB::table('pedidos')
     ->join('empresas', 'pedidos.empresa_id', '=', 'empresas.id')
     ->select('empresas.nombre as empresa','pedidos.estado as state','pedidos.id as pedido', 'pedidos.created_at as date')
     ->where(
       [
         ['pedidos.user_id','=', Auth::user()->persona_id],
         ['pedidos.id','=', $request->get('id')]
       ]
     )
     ->get();

    } catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
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
    // return $request->get('total');
    try {
      foreach ($request->get('empresas') as $key => $empresa) {
        $pedido = Pedidos::create([
            'empresa_id' => $empresa['empresa'],
            'latitud'=>$empresa['lat'],
            'longitud'=>$empresa['lng'],
            'user_id'=>Auth::id(),
            'tipo_id'=>$empresa['tipoEntrega'],
            'direccion'=>$empresa['direccion'],
            'monto'=>$empresa['total']
        ]);

        //$details = array();

        foreach ($request->get('productos') as $key => $producto) {
            if ($producto['empresa'] == $empresa['empresa']) {
                //array_push($details, $producto);
                DB::table('detalle_pedidos')->insert(
                    [
                    'producto_id'=>$producto['id'],
                    'pedido_id'=>$pedido->id,
                    'cantidad'=>$producto['cant'],
                    'precio_unit'=>$producto['precio']
                    ]
                );
            }
        }
		$dato_pedido = Pedidos::obtenerPedido($pedido->id);
        try { event(new NewOrderEvent($empresa['empresa'], $dato_pedido));} catch (\Throwable $th) {}
      }
      return 1;
    } catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }


  public function ListEmpresas( Request $request){
     
    try {
      $empresas =DB::table('empresas')
      ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
      ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
      ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')     
      ->where('empresas.nombre','like','%'.$request->get('search').'%')
      // ->whereRaw('MATCH(empresas.nombre ) AGAINST (?)', ["'".$request->get('search')."'"])
      ->groupBy('empresas.id')
      ->get();
      if (count($empresas)>0) {        
        return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$request->get('search')]);
      }else{
       
        $empresas =DB::table('empresas')
        ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
        ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
        ->where('categorias.descripcion','like','%'.$request->get('search').'%')
        ->get();
        if (count($empresas)>0) {
          return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$request->get('search') ]);
        }
         return view('front.listEmpresa', ["empresas" => null, 'search'=>$request->get('search')]);
      }

    } catch (\Throwable $th) {
       return view('front.listEmpresa', ["empresas" => null, 'search'=>$request->get('search')]);
    }

  }
  public function BuscaxCategoria(  $Categoria){

      try {
        $empresas =DB::table('empresas')
        ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
        ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
        ->where('categorias.descripcion','like','%'.$Categoria.'%')
        ->get();
        return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$Categoria]);
      } catch (\Throwable $th) {
        return view('front.listEmpresa', ["empresas" => null, 'search'=>$Categoria]);
      }


  }
  public function BuscaxUbicacion($Ubicacion){
    try {
      $empresas =DB::table('empresas')
      ->join('ciudad', 'ciudad.id', '=', 'empresas.ciudad_id')
      ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
      ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
      ->selectRaw('empresas.id ,empresas.nombre,empresas.nombre_unico,empresas.descripcion,empresas.foto,categorias.descripcion as categoria')      
      ->where('ciudad.nombre','like','%'.$Ubicacion.'%')
      ->groupBy('empresas.id')
      ->get();
      return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$Ubicacion]);
    } catch (\Throwable $th) {
      return view('front.listEmpresa', ["empresas" => null, 'search'=>$Ubicacion]);
    }
}
  public function Empresa($nombre){
      try {
        $empresa =DB::table('empresas')
        ->join('ciudad', 'ciudad.id', '=', 'empresas.ciudad_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto', 'ciudad.nombre as ciudad', 'ciudad.distrito_id')
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
    $where=[
      ['empresas.id', '=', $request->get('id')],
      ['productos.usuario_puede_ver', '=',1],
      ['productos.estado', '=',1],
    ];
    if($request->get('search')!='')
    {
      $where[]=['productos.nombre', '=', $request->get('search')];
    }
    try {
      if($request->get('tipo')=='all'){
        return DB::table('empresas')
        ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
        ->select('productos.nombre', 'productos.descripcion','productos.precio','productos.foto', 'productos.id')
        ->where($where)
        ->paginate(10,[],'',$request->get('page'));
        // ->get();
      } 
      $where[]=['categorias_menus.id', '=', $request->get('tipo')];
      return DB::table('empresas')
      ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
      ->join('categorias_menus', 'categorias_menus.id', '=', 'productos.categorias_menu_id')
      ->select('productos.nombre', 'productos.descripcion','productos.precio','productos.foto', 'productos.id')
      ->where($where)
      ->paginate(10,[],'',$request->get('page'));
      // ->get();

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
  public function CategoriasxNegocio(Request $request)
  {
    
     try {
      if($request->get('id')==0)
      {
        return DB::table('categorias')
        ->join('tipo_negocio', 'tipo_negocio.id', '=', 'categorias.tipo_negocio_id') 
        ->selectRaw('categorias.id,categorias.descripcion')
        ->get();
      }
        return DB::table('categorias')
        ->join('tipo_negocio', 'tipo_negocio.id', '=', 'categorias.tipo_negocio_id') 
        ->selectRaw('categorias.id,categorias.descripcion')        
        ->where('tipo_negocio.id', '=',$request->get('id'))   
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
  public function TipoNegocio()
  {
     try {
      return DB::table('tipo_negocio')        
        ->selectRaw('tipo_negocio.id, tipo_negocio.descripcion')         
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
}
