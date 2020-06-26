<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contrato extends Model
{
	protected $table = 'contratos';
	protected $fillable = [
		'id',
		'empresa_id',
		'plan_id',
		'pago_id',
		'estado',
		'plan_monto',
		'fecha_inicio',
		'fecha_vencimiento',
		'created_at',
		'updated_at'
	];
	protected $casts = [
		'fecha_inicio' => 'datetime:d/m/Y h:i a',
		'fecha_vencimiento' => 'datetime:d/m/Y h:i a',
		'fecha_pago' => 'datetime:d/m/Y h:i a',
		'fecha_confirmacionpago' => 'datetime:d/m/Y h:i a'
	];

	public static function listacontratos($empresa_id){
		return Contrato::where(['contratos.empresa_id' => $empresa_id])
			->select('contratos.id',
				'contratos.estado',
				'contratos.plan_monto',
				'contratos.fecha_inicio',
				'contratos.fecha_vencimiento',
				'pl.id',
				'pl.nombre as plan_nombre',
				'pl.descripcion',
				'pa.id',
				'pa.monto',
				'pa.estado',
				'pa.created_at as fecha_pago',
				'pa.updated_at as fecha_confirmacionpago')
			->join('pagos as pa', 'pa.id', '=', 'contratos.pago_id')
			->join('plan as pl', 'pl.id', '=', 'contratos.plan_id')
			->orderByDesc('contratos.fecha_inicio')
			->get();
	}
}
