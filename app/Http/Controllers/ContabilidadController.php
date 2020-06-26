<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedidos;
use App\Producto;
use App\Http\Controllers\PedidosController;
use App\Events\ChangeStateOrderEvent;
use App\Contrato;
//use App\Plan;
//use App\Pagos;

class ContabilidadController extends Controller
{
	public function fn1(Request $request){
		return $this->fn('1', $request);
	}
	public function fn2(Request $request){
		return $this->fn('2', $request);
	}
	public function fn($funcion='', Request $request){
		if ($funcion == 'listarentregados') return $this->listarentregados($request);//1
		if ($funcion == 'listacontratos') return $this->listacontratos($request);//2
		else if ($funcion == '1') return view('admin.negocio.ventas'/*, ["empresa" => session('empresa')]*/);
		else if ($funcion == '2') return view('admin.negocio.pagos'/*, ["empresa" => session('empresa')]*/);
		else return '';
	}

	static function listacontratos(Request $request){
        $empresa_id = session('empresa');
		return Contrato::listacontratos($empresa_id);
	}

	static function listarentregados(Request $request){
		$fecha = $request->fecha;
		return PedidosController::listarentregadofecha($fecha, $request);
	}
}
