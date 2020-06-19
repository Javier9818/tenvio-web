<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedidos;
use App\Producto;
use App\Events\ChangeStateOrderEvent;

class PedidosController extends Controller
{
    public function show($id){
        $detalle = DB::table('detalle_pedidos')
            ->join('productos', 'productos.id', '=', 'detalle_pedidos.producto_id')
            ->where('detalle_pedidos.pedido_id', '=', $id)
            ->get();
            return response()->json(["detalle" => $detalle], 200);
    }

	public function fn2($funcion='', Request $request){
		return $this->fn('2', $request);
	}
	public function fn3($funcion='', Request $request){
		return $this->fn('3', $request);
	}
	public function fn4($funcion='', Request $request){
		return $this->fn('4', $request);
	}
    public function fn($funcion='', Request $request){
		if ($funcion == 'listartodo') return $this->listartodo($request);
		else if ($funcion == 'listarrecepcion') return $this->listarrecepcion($request);
		else if ($funcion == 'listardelivery') return $this->listardelivery($request);
		else if ($funcion == 'listarempleados') return $this->listarempleados($request);
		else if ($funcion == 'aceptar') return $this->aceptar($request);
		else if ($funcion == 'cancelar') return $this->cancelar($request);
		else if ($funcion == 'entregar') return $this->entregar($request);
		else if ($funcion == 'asignar') return $this->asignar($request);
		else if ($funcion == 'cancelartodos') return $this->cancelartodos($request);
		else if ($funcion == 'listaxRepartidor') return $this->listaxRepartidor($request);
		else if ($funcion == '2') return view('admin.pedidos.pedidosRecepcion', ["empresa" => session('empresa')]);
		else if ($funcion == '3') return view('admin.pedidos.asignacionDelivery', ["empresa" => session('empresa')]);
		else if ($funcion == '4') return view('admin.pedidos.estadoPedido', ["empresa" => session('empresa')]);
		else return view('admin.pedidos.pedidos',  ["empresa" => session('empresa')]);
    }

	static function listaxRepartidor(Request $request)
	{
		try {
      return DB::table('asignacion')
      ->join('users', 'users.id', '=', 'asignacion.user_id')
			->join('pedidos_users', 'asignacion.id', '=', 'pedidos_users.asignacion_id')
			->join('pedidos', 'pedidos.id', '=', 'pedidos_users.pedidos_id')
			->join('detalle_pedidos', 'detalle_pedidos.pedido_id', '=', 'pedidos.id')
			->select('pedidos.id as Idpedido','pedidos.direccion as Direccion',
					DB::raw('sum(detalle_pedidos.precio_unit*detalle_pedidos.cantidad) as Monto')
				)
      ->where(
				[
					['asignacion.created_at','=',$request->get('fecha')],
					['asignacion.user_id','=',$request->get('user')]
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
	static function listartodo(Request $request){
		return static::listarPedidos('Todo', 'Hoy', $request);
	}

	static function listarrecepcion(Request $request){
		return static::listarPedidos('Recepcion', 'Hoy', $request);
	}

	static function listardelivery(Request $request){
		return static::listarPedidos('Delivery', 'Hoy', $request);
	}

	static function listarentregadofecha($fecha, Request $request){
		return static::listarPedidos('Entregado', $fecha, $request);
	}

	static function listarPedidos($tipo, $fecha, $request){
        $empresa_id = session('empresa');
		$datos = array();
		$datos['pedidos'] = Pedidos::listar($empresa_id, $tipo, $fecha);
		$datos['productos_pedido'] = Producto::listarProductosDePedido($empresa_id);
		if ($tipo == 'Todo')
			$datos['categorias_productos'] = CategoriasMenusController::listarvselect($request)->original;
		//return (CategoriasMenusController::listarvselect($request));
        return response()->json($datos, 200);
	}

	static function listarempleados(Request $request){
		$empresa_id = session('empresa');
		return Pedidos::listarEmpleados($empresa_id);
	}

	static function asignar(Request $request){
		$idrepartidor = $request->get('idrepartidor');
		$pedidos = $request->get('pedidos');
		Pedidos::asignar($pedidos, $idrepartidor);
		foreach ($pedidos as $item) {
			$idCliente = $item['idusuario'];
			try { event( new ChangeStateOrderEvent(["pedido" => $item, "state" => 'ENVIANDO'], $idCliente));} catch (\Throwable $th) {}
		}
	}
	/*
	static function asignar(Request $request){
        $idpedido = $request->get('idpedido');
        $idCliente = $request->get('idusuario');
		$idrepartidor = $request->get('idrepartidor');
        Pedidos::asignar($idpedido, $idrepartidor);
        try { event( new ChangeStateOrderEvent(["pedido" => $request->pedido, "state" => 'ENVIANDO'], $idCliente));} catch (\Throwable $th) {}
	}
	*/

	public static function entregar(Request $request){
		$idpedido = $request->get('idpedido');
        Pedidos::entregar($idpedido);
        return response()->json(["Message" => "ok"], 200);
	}

	static function aceptar(Request $request){
        $idpedido = $request->get('idpedido');
        $idCliente = $request->get('idusuario');
        Pedidos::aceptar($idpedido);
        try { event( new ChangeStateOrderEvent(["pedido" => $request->pedido, "state" => 'ACEPTADO'], $idCliente));} catch (\Throwable $th) {}
    }

    static function cancelaByRepartidor(Request $request){
        $pedido = Pedidos::where('id', $request->pedido)->update(['estado' => 'REPORTADO','comentario' => 'Problemas en la entrega']);
        return response()->json([$pedido]);
    }

	static function cancelar(Request $request){
		$idpedido = $request->get('idpedido');
        $comentario = $request->get('comentario');
        $idCliente = $request->get('idusuario');
        Pedidos::cancelar($idpedido, $comentario);
        try { event( new ChangeStateOrderEvent(["pedido" => $request->pedido, "state" => 'CANCELADO', "comentario" => $comentario], $idCliente));} catch (\Throwable $th) {}
	}

	static function cancelartodos(Request $request){
		$comentario = $request->get('comentario');
		$pedidos = $request->get('pedidos');
		$id_pedidos = array();
		foreach ($pedidos as $item) {
			$id_pedidos[] = $item['idpedido'];
		}
		Pedidos::cancelarvarios($id_pedidos, $comentario);
		foreach ($pedidos as $item) {
			$idCliente = $item['idusuario'];
			try { event( new ChangeStateOrderEvent(["pedido" => $item, "state" => 'CANCELADO', "comentario" => $comentario], $idCliente));} catch (\Throwable $th) {}
		}
	}

	static function funcion(Request $request){
	}
}
