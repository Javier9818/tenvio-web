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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCargo;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
  public static function Funciones($opcion,Request $request)
  {
    switch ($opcion) {
      case 'productos':
        return FrontController::productos($request);
        break;
      case 'categorias':
        return FrontController::categorias($request);
        break;
      case 'GeneraPedido':
        return FrontController::GeneraPedido($request);
        break;
      case 'TipoPedido':
        return FrontController::TipoPedido($request);
        break;
      case 'ListPedido':
        return FrontController::ListPedido($request);
        break;
      case 'encripta':
        return FrontController::encripta($request);
        break;
      case 'getPedido':
        return FrontController::getPedido($request);
        break;
      case 'CategoriasxNegocio':
        return FrontController::CategoriasxNegocio($request);
        break;
      case 'TipoNegocio':
        return FrontController::TipoNegocio();
        break;
      case 'Valida':
        return FrontController::Valida();
        break;
      case 'recupera':
        return FrontController::recupera($request);
        break;
      case 'recuperaPost':
        return FrontController::recuperaPost($request);
        break;
      default:
        # code...
        break;
    }
  }
  public static function recupera($request)
  {
     try {
      $id= DB::table('users')
      ->join('personas','personas.id','=','users.id')
      ->selectRaw('users.id, users.email, concat(personas.nombres," ",personas.appaterno," ",personas.apmaterno) as persona')
      ->where('users.username','=',$request->get('user'))
      ->orWhere('users.email','=',$request->get('user'))
      ->get(); 
        if(count($id))
          return FrontController::EnviaEmail($id[0]);
        else 
          return false;
     } catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
    }


  }
  public static function EnviaEmail($request)
	{
    
		try { 
			$cifrado = Crypt::encrypt(json_encode(["id" => $request->id]));
      $url = 'http://127.0.0.1:8000/recoverypassword/'.$cifrado;
      $mensaje='Hola, se ha recibido su solicitud de "RECUPERACIÓN DE CONTRASEÑA", por favor ingrese al siguiente link: '.$url.' para poder realizarlo.';
			Mail::to($request->email)->send(new SendCargo($request->persona, $url, $request->email, $mensaje));
			return true;
		}  catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
    }
  }
  public static function recuperaPost($request)
  {
    try {
      return DB::table('users')
        ->where('id', $request->get('user'))
        ->update(['password' => Hash::make($request->get('pass'))]);
    }  catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
    }
  }
  public  function Recover($cifrado)
  {
    try {
      $decrypted = Crypt::decrypt($cifrado);
      $decrypted = json_decode($decrypted);
      return view('front.recovery', ["data"=>$decrypted]);
    } catch ( DecryptException $e) {
      return abort(404);
    }

  }
  public static function Valida()
  {

    return (Auth::id()==null)? 0:1;
  }
  public static function categoriasIndex()
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
  public static function encripta($request)
	{
		return "/seguimiento/".Crypt::encrypt(json_encode(["id" => $request->id]));
	}
  public static function seguimiento($cifrado)
	{
		try {
      $decrypted = Crypt::decrypt($cifrado);
      $decrypted = json_decode($decrypted);
      return view('front.seguimiento', ["data"=>$decrypted]);
    } catch ( \Throwable $th) {
      return abort(404);
    }
  }
  public static function ListPedido($request)
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
  public static function getPedido($request)
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
  public static function TipoPedido(Request $request)
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
  public static function GeneraPedido( Request $request)
  {

    DB::transaction(function () use ($request){
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

            foreach ($request->get('productos') as $key => $producto) {
                if ($producto['empresa'] == $empresa['empresa']) {
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
    });

  }


  public static function ListEmpresas( Request $request){

    try {
      $empresas =DB::table('empresas')
      ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
      ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
      ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
      ->where(
        [
          ['empresas.nombre','like','%'.$request->get('search').'%'],
          ['empresas.estado', '!=', 'VENCIDO']
        ])
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
        ->where(
          [
            ['categorias.descripcion','like','%'.$request->get('search').'%'],
            ['empresas.estado', '!=', 'VENCIDO']
          ])
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
  public static function BuscaxCategoria(  $Categoria){

      try {
        $empresas =DB::table('empresas')
        ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
        ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto','categorias.descripcion as categoria')
        ->where(
          [
            ['categorias.state','=',1],
            ['categorias.descripcion','like','%'.$Categoria.'%'],
            ['empresas.estado', '!=', 'VENCIDO']
          ]
          )
        ->get();
        return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$Categoria]);
      } catch (\Throwable $th) {
        return view('front.listEmpresa', ["empresas" => null, 'search'=>$Categoria]);
      }


  }
  public static function BuscaxUbicacion($Ubicacion){
    try {
      $empresas =DB::table('empresas')
      ->join('ciudad', 'ciudad.id', '=', 'empresas.ciudad_id')
      ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
      ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
      ->selectRaw('empresas.id ,empresas.nombre,empresas.nombre_unico,empresas.descripcion,empresas.foto,categorias.descripcion as categoria')      
      ->where(
        [
          ['categorias.state','=',1],
          ['ciudad.nombre','like','%'.$Ubicacion.'%'],
          ['empresas.estado', '!=', 'VENCIDO']
        ])
      ->groupBy('empresas.id')
      ->get();
      return view('front.listEmpresa', ["empresas" => $empresas, 'search'=>$Ubicacion]);
    } catch (\Throwable $th) {
      return view('front.listEmpresa', ["empresas" => null, 'search'=>$Ubicacion]);
    }
}
  public static function Empresa($nombre){
      try {
        $empresa =DB::table('empresas')
        ->join('ciudad', 'ciudad.id', '=', 'empresas.ciudad_id')
        ->select('empresas.id','empresas.nombre','empresas.nombre_unico','empresas.descripcion','empresas.foto', 'ciudad.nombre as ciudad', 'ciudad.distrito_id')
        // ->where('empresas.nombre','=',str_replace('-',' ',$nombre))
        ->where(
          [
            ['empresas.nombre_unico','=', $nombre],
            ['empresas.estado', '!=', 'VENCIDO']
          ])
        ->get();
        return view('front.empresa')->with("data",$empresa);
      }catch (\Exception  $e) {
        return abort(404);
     }

  }
  public static function productos(Request $request)
  { 
    // $state=DB::table('empresa')
    // ->select('empresa.estado')
    // ->where('empresas.id', '=', $request->get('id'))
    // ->get();
    // if($state[0]=='VENCIDO')
    //   return [
    //     'Message'=> 'error',
    //     'success'=>false
    //   ];
    $where=[
      ['empresas.id', '=', $request->get('id')],
      ['empresas.estado', '!=', 'VENCIDO'],
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
  public static function categorias(Request $request)
  {
     try {
      return DB::table('empresas')
        ->join('productos', 'productos.empresa_id', '=', 'empresas.id')
        ->join('categorias_menus', 'categorias_menus.id', '=', 'productos.categorias_menu_id')
        ->selectRaw(' DISTINCT categorias_menus.descripcion as text, categorias_menus.id as value')
        ->where(
        [ 
          ['empresas.id','=',$request->get('id')],
          ['empresas.estado', '!=', 'VENCIDO']
        ])
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
  public static function CategoriasxNegocio(Request $request)
  {

     try {
      if($request->get('id')==0)
      {
        return DB::table('categorias')
        ->join('tipo_negocio', 'tipo_negocio.id', '=', 'categorias.tipo_negocio_id')
        ->selectRaw('categorias.id,categorias.descripcion,categorias.icon')
        ->where(
          [ 
            ['categorias.state','=',1]
          ])   
        ->get();
      }
        return DB::table('categorias')
        ->join('tipo_negocio', 'tipo_negocio.id', '=', 'categorias.tipo_negocio_id') 
        ->selectRaw('categorias.id,categorias.descripcion,categorias.icon')        
        ->where(
          [
            ['tipo_negocio.id', '=',$request->get('id')],
            ['categorias.state','=',1]
          ])   
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
  public static function TipoNegocio()
  {
     try {
      return DB::table('tipo_negocio')        
        ->selectRaw('tipo_negocio.id, tipo_negocio.descripcion')      
        ->where('tipo_negocio.state','=',1)   
        ->get();
     }catch (\Exception  $e) {
      return [
        'Message'=> $e->getMessage(),
        'success'=>false
      ];
   }
  }
}
