<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pagos extends Model
{
	protected $table = 'pagos';
	protected $fillable = [
		'id',
		'empresa_id',
		'contratos_id',
		'plan_id',
		'precio',
		'cantidad_pedidos',
		'urlfoto',
		'estado',
		'observacion',
		'created_at',
		'updated_at'
	];
	protected $casts = [
		'fecha_pago' => 'datetime:d/m/Y h:i a'
	];

	//negocio
	/*
	public static function actualizarRechazado($pago){
		return Pagos::where('id', $pago->id)
			->update([
				'estado' => 'Pago Actualizado'
			]);
	}
	*/
	public static function getPago($pago_id){
		return Pagos::find($pago_id);
	}
	public static function registrar($contrato, $voucher, $plan = ''){
		return Pagos::create([
			'empresa_id' => $contrato->empresa_id,
			'contratos_id' => $contrato->id,
			'plan_id' => ($plan=='')?$contrato->plan_id:$plan->id,
			'precio' => ($plan=='')?$contrato->plan_precio:$plan->precio,
			'cantidad_pedidos' => ($plan=='')?$contrato->pedidos_total:$plan->cantidad_pedidos,
			'urlfoto' => $voucher,
			'estado' => 'Pendiente a Aprobar',
			'observacion' => null
		]);
	}
	//admin
	public static function listarPagos(){
		return Pagos::select(
				'pagos.id',
				'pagos.precio',
				'pagos.cantidad_pedidos',
				'pagos.urlfoto',
				'pagos.created_at as fecha_pago',
				'pagos.estado',
				'pl.id as plan_id',
				'pl.nombre as plan_nombre',
				'e.nombre as emp_nombre',
				'e.telefono as telefono',
				'e.celular as celular'
				)
			->join('plan as pl', 'pl.id', '=', 'pagos.plan_id')
			->join('empresas as e', 'e.id', '=', 'pagos.empresa_id')
			->orderByDesc('pagos.created_at')
			->get();
	}
	public static function rechazar($pago_id, $observacion){
		Pagos::where('id', $pago_id)
			->update([
				'estado' => 'Rechazado',
				'observacion' => $observacion
			]);
	}
	public static function aprobar($pago_id){
		Pagos::where('id', $pago_id)
			->update([
				'estado' => 'Aprobado'
			]);
	}
	public static function getPagoPlan($pago_id){
		return Pagos::where(['pagos.id' => $pago_id])
			->select('pagos.empresa_id', 'pagos.cantidad_pedidos','pl.tipo')
			->join('plan as pl', 'pl.id', '=', 'pagos.plan_id')
			->first();
	}


	/*
	public static function registrarPago($empresa_id, $contratos_id, $urlFotoVoucher, $monto){
		return Pagos::create([
			'empresa_id' => $empresa_id,
			'contratos_id' => $contratos_id,
			'urlfoto' => $urlFotoVoucher,
			'monto' => $monto,
			'estado' => 'EN ESPERA A APROBAR',
			'fecha_pago' => Carbon::now()
		]);
	}
	*/
}
