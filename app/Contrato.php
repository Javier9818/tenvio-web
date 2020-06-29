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

	public static function listaContratos($empresa_id){
		return static::consultaContratos(['contratos.empresa_id' => $empresa_id]);
	}
	public static function obtenerContrato($contratos_id){
		return static::consultaContratos(['contratos.id' => $contratos_id])->first();
	}
	public static function consultaContratos($where){
		return Contrato::where($where)
			->select('contratos.id',
				//'contratos.estado as contrato_estado',
				//'pa.estado as pago_estado',
				DB::raw("CASE WHEN pa.estado is NULL then contratos.estado else pa.estado end as estado"),
				DB::raw("CASE WHEN pa.monto is NULL then contratos.plan_monto else pa.monto end as monto"),
				//'contratos.plan_monto',
				//'pa.monto',
				'contratos.fecha_inicio',
                'contratos.fecha_vencimiento',
                'contratos.created_at',
				'pl.id as plan_id',
				'pl.nombre as plan_nombre',
				'pl.descripcion',
				'pa.id as pagos_id',
				'pa.urlfoto',
				'pa.created_at as fecha_pago',
				'pa.updated_at as fecha_confirmacionpago')
			->join('plan as pl', 'pl.id', '=', 'contratos.plan_id')
			->leftJoin('pagos as pa', 'pa.contratos_id', '=', 'contratos.id')
			->orderByDesc('contratos.fecha_inicio')
			->get();
	}
}
