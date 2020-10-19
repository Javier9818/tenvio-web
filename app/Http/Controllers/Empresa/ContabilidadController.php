<?php
namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\PedidosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedidos;
use App\Producto;
use App\Events\ChangeStateOrderEvent;
use App\Contrato;
use App\Plan;
use App\Pagos;
use App\Http\Controllers\ExtrasController;

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
		else if ($funcion == 'listaplanes') return $this->listaplanes($request);//2
		else if ($funcion == 'listaextensiones') return $this->listaextensiones($request);//2
		else if ($funcion == 'renovarcontrato') return $this->renovarcontrato($request);//2
		else if ($funcion == 'listacontratos') return $this->listacontratos($request);//2
		else if ($funcion == 'actualizarvoucher') return $this->actualizarvoucher($request);//2
		else if ($funcion == 'extenderplan') return $this->extenderplan($request);//2
		else if ($funcion == 'pagosporcontrato') return $this->pagosporcontrato($request);//2
		else if ($funcion == '1') return view('admin.negocio.ventas'/*, ["empresa" => session('empresa')]*/);
		else if ($funcion == '2') return view('admin.negocio.pagos'/*, ["empresa" => session('empresa')]*/);
		else return '';
	}

	static function pagosporcontrato(Request $request){
		$empresa_id = session('empresa');
		$contrato_id = $request->get('contrato_id');
		return Pagos::pagosporcontrato($empresa_id, $contrato_id);
	}

	static function extenderplan(Request $request){
		$empresa_id = session('empresa');
		$contrato_id = $request->get('contrato_id');
		$plan_id = $request->get('plan_id');
		$voucher = $request->get('voucher');
		$voucher = $voucher[0]['upload']['data'];
		DB::beginTransaction();
		try {
			$plan = Plan::getPlan($plan_id);
			$contrato = Contrato::getContrato($contrato_id);
			Pagos::registrar($contrato, $voucher, $plan);
			ExtrasController::moverFotoVoucher($voucher);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			return ['mensaje' => '.'];
		}
		return ['mensaje' => ''];
	}

	static function actualizarvoucher(Request $request){
		$empresa_id = session('empresa');
		$pago_id = $request->get('pago_id');
		$voucher = $request->get('voucher');
		$voucher = $voucher[0]['upload']['data'];
		DB::beginTransaction();
		try {
			$pago = Pagos::getPago($pago_id);
			$contrato = Contrato::getContrato($pago->contratos_id);
			$contratonuevo = Contrato::duplicar($contrato, true);
			Pagos::registrar($contratonuevo, $voucher);
			ExtrasController::moverFotoVoucher($voucher);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			//dd($e);
			return ['mensaje' => '.'];
		}
		return ['mensaje' => ''];
	}

	static function listacontratos(Request $request){
		$empresa_id = session('empresa');
		return [
			'lista' => Contrato::listaContratos($empresa_id),
			'rutaImagenes' => ExtrasController::$rutaFotosVouchers
		];
	}

	static function renovarcontrato(Request $request){
		$empresa_id = session('empresa');
		$plan_id = $request->get('plan_id');
		$voucher = $request->get('voucher');
		$voucher = $voucher[0]['upload']['data'];
		DB::beginTransaction();
		try {
			$plan = Plan::getPlan($plan_id);
			$contrato = Contrato::renovar($empresa_id, $plan);
			Pagos::registrar($contrato, $voucher);
			ExtrasController::moverFotoVoucher($voucher);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			//dd($e);
			return ['mensaje' => '.'];
		}
		return ['mensaje' => ''];
	}

	static function listaextensiones(Request $request){
		return Plan::listaExtensiones();
	}

	static function listaplanes(Request $request){
		return Plan::listaPlanes();
	}

	/*
	static function registrarvoucher(Request $request){
		$empresa_id = session('empresa');
		$contrato = $request->get('contrato');
		$contratos_id = $contrato['id'];
		$urlFotoVoucher = $contrato['fotovouchersubir'][0]['upload']['data'];
		$monto = $contrato['monto'];
		Pagos::registrarPago($empresa_id, $contratos_id, $urlFotoVoucher, $monto);
		ExtrasController::moverFotoVoucher($urlFotoVoucher);
		//$contrato = Contrato::obtenerContrato($contratos_id);
		//dd($urlFotoVoucher);
		return [
			'mensaje' => '',
			'contrato' =>Contrato::obtenerContrato($contratos_id)
		];
	}
	static function listacontratos(Request $request){
		$empresa_id = session('empresa');
		return [
			'lista' => Contrato::listaContratos($empresa_id),
			'rutaImagenes' => ExtrasController::$rutaFotosVouchers
		];
	}
	*/

	static function listarentregados(Request $request){
		$fecha = $request->fecha;
		return PedidosController::listarentregadofecha($fecha, $request);
	}
}
