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

	public static function actualizarRechazado($pago){
		return Pagos::where('id', $pago->id)
			->update([
				'estado' => 'Pago Actualizado'
			]);
	}

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
