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
		'urlfoto',
		'monto',
		'estado',
		'fecha_pago',
		'created_at',
		'updated_at'
	];

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
}
