<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ExtrasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Pedidos;
use App\Producto;

class PedidosController extends Controller
{
	public function fn2($funcion='', Request $request){
		return $this->fn('2', $request);
	}
	public function fn3($funcion='', Request $request){
		return $this->fn('3', $request);
	}
    public function fn($funcion='', Request $request){
		if ($funcion == 'listartodo') return $this->listartodo($request);
		else if ($funcion == 'listarrecepcion') return $this->listarrecepcion($request);
		else if ($funcion == 'listardelivery') return $this->listardelivery($request);
		else if ($funcion == 'listarempleados') return $this->listarempleados($request);
		else if ($funcion == 'aceptar') return $this->aceptar($request);
		else if ($funcion == 'anular') return $this->anular($request);
		else if ($funcion == 'entregar') return $this->entregar($request);
		else if ($funcion == 'asignar') return $this->asignar($request);
		else if ($funcion == '2') return view('admin.pedidos.pedidosRecepcion');
		else if ($funcion == '3') return view('admin.pedidos.asignacionDelivery');
		else return view('admin.pedidos.pedidos',  ["empresa" => Session::get('empresa')]);
    }

	static function listartodo(Request $request){
		return static::listarPedidos('Todo');
	}

	static function listarrecepcion(Request $request){
		return static::listarPedidos('Recepcion');
	}

	static function listardelivery(Request $request){
		return static::listarPedidos('Delivery');
	}

	static function listarPedidos($tipo){
        $empresa_id = Session::get('empresa');
        $pedidos = Pedidos::listar($empresa_id, $tipo);
        $productos_pedido = Producto::listarProductosDePedido($empresa_id);
        return response()->json(['pedidos' => $pedidos, 'productos_pedido' => $productos_pedido], 200);
	}

	static function listarempleados(Request $request){
		$empresa_id = Session::get('empresa');
		return Pedidos::listarEmpleados($empresa_id);
	}

	static function asignar(Request $request){
		$idpedido = $request->get('idpedido');
		$idrepartidor = $request->get('idrepartidor');
		Pedidos::asignar($idpedido, $idrepartidor);
	}

	static function entregar(Request $request){
		$idpedido = $request->get('idpedido');
		Pedidos::entregar($idpedido);
	}

	static function aceptar(Request $request){
		$idpedido = $request->get('idpedido');
		Pedidos::aceptar($idpedido);
	}

	static function anular(Request $request){
		$idpedido = $request->get('idpedido');
		$comentario = $request->get('comentario');
		Pedidos::anular($idpedido, $comentario);
	}

	static function funcion(Request $request){
	}
}
