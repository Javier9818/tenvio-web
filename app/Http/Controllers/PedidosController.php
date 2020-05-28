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
    public function fn($funcion='', Request $request){
		if ($funcion == 'listar') return $this->listar($request);
		//else if ($funcion == 'setupddel') return $this->setupddel($request);
		//else if ($funcion == 'setupddel') return $this->setupddel($request);
		else return view('admin.pedidos.pedidos');
    }

	static function listar(Request $request){
		$empresa_id = Session::get('empresa');
		$pedidos = Pedidos::listar($empresa_id);
		$productos_pedido = Producto::listarProductosDePedido($empresa_id);
		return array('pedidos' => $pedidos, 'productos_pedido' => $productos_pedido);
	}

	static function funcion(Request $request){
	}
}
