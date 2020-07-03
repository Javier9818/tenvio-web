<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Contrato extends Model
{
	protected $table = 'contratos';
	protected $fillable = [
		'id',
		'empresa_id',
		'plan_id',
		'estado',
		'plan_precio',
		'pedidos_total',
		'pedidos_contador',
		'fecha_inicio',
		'fecha_vencimiento',
		'created_at',
		'updated_at'
	];
	protected $casts = [
		'fecha_inicio' => 'datetime:d/m/Y h:i a',
		'fecha_vencimiento' => 'datetime:d/m/Y h:i a'
	];
	/*
	protected $casts = [
		'fecha_inicio' => 'datetime:d/m/Y h:i a',
		'fecha_vencimiento' => 'datetime:d/m/Y h:i a',
		'fecha_pago' => 'datetime:d/m/Y h:i a',
		'fecha_confirmacionpago' => 'datetime:d/m/Y h:i a'
	];
	*/
	public static $CONTRATO_VIGENTE = 'Vigente';
	public static $CONTRATO_RECHAZADO = 'Rechazado';
	public static $CONTRATO_REINTENTADO = 'Reintentado';
	public static $CONTRATO_ENESPERA = 'En espera a validar';

	//static::$CONTRATO_ENESPERA

	public static function agregarExtension($empresa_id, $cantidad_pedidos){
		return Contrato::where(['empresa_id' => $empresa_id])
			->increment('pedidos_total', $cantidad_pedidos);
	}

	public static function seHaPagado($empresa_id, $estado){
		Contrato::where(['empresa_id' => $empresa_id, 'estado' => static::$CONTRATO_ENESPERA])
			->update([
				'estado' => ($estado)?(static::$CONTRATO_VIGENTE):(static::$CONTRATO_RECHAZADO)
			]);
	}

	public static function getContrato($contratos_id){
		return Contrato::find($contratos_id);
	}

	public static function listaContratos($empresa_id){
		return static::consultaContratos(['contratos.empresa_id' => $empresa_id]);
	}

	public static function consultaContratos($where){
		return Contrato::whereRaw('pl.id = contratos.plan_id AND contratos.plan_id = pa.plan_id')
			->where($where)
			->select('contratos.id',
				'contratos.pedidos_contador',
				'contratos.pedidos_total',
				DB::raw('(
					SELECT GROUP_CONCAT(pagos.cantidad_pedidos) FROM pagos WHERE pagos.contratos_id = contratos.id)
					AS pedidos_total_'
				),
				'contratos.fecha_inicio',
				'contratos.fecha_vencimiento',
				'contratos.estado',
				'pl.id as plan_id',
				'pl.nombre as plan_nombre',
				'pa.id as pago_id',
				'pa.precio'
				)
			->join('plan as pl', 'pl.id', '=', 'contratos.plan_id')
			->join('pagos as pa', 'pa.contratos_id', '=', 'contratos.id')
			->orderByDesc('contratos.fecha_inicio')
			->orderByDesc('contratos.id')
			//->toSql();
			->get();
	}
	/*
	public static function consultaContratos($where){
		return Contrato::where($where)
			->select('contratos.id',
				'contratos.pedidos_total',
				DB::raw("case
					when pa.estado = 'Aprobado' then contratos.estado
					when contratos.estado = 'Válido' then pa.estado
					else contratos.estado end as estado"
					),
				'contratos.fecha_inicio',
				'contratos.fecha_vencimiento',
				'pl.id as plan_id',
				'pl.nombre as plan_nombre',
				'pa.id as pago_id',
				'pa.precio',
				'pa.urlfoto',
				'pa.created_at as fecha_pago'
				)
			->join('plan as pl', 'pl.id', '=', 'contratos.plan_id')
			->leftJoin('pagos as pa', 'pa.contratos_id', '=', 'contratos.id')
			->orderByDesc('contratos.fecha_inicio')
			->orderByDesc('pa.created_at')
			->get();
	}
	*/
	public static function duplicar($contrato, $anularElAnterior){
		if ($anularElAnterior){
			$contrato->estado = static::$CONTRATO_REINTENTADO;
			$contrato->save();
		}
		return Contrato::create([
			'empresa_id' => $contrato->empresa_id,
			'plan_id' => $contrato->plan_id,
			'estado' => static::$CONTRATO_ENESPERA,
			'plan_precio' => $contrato->plan_precio,
			'pedidos_total' => $contrato->pedidos_total,
			'fecha_inicio' => $contrato->fecha_inicio,
			'fecha_vencimiento' =>$contrato->fecha_vencimiento
		]);
	}
	public static function renovar($empresa_id, $plan){
		$ultimoContrato = Contrato::where(['empresa_id' => $empresa_id, 'estado' => static::$CONTRATO_VIGENTE])
			->select('id', 'fecha_inicio', 'fecha_vencimiento')
			->orderByDesc('fecha_vencimiento')
			->first();
		if ($ultimoContrato == null)
			$fechaInicio = Carbon::now();
		else
			$fechaInicio = $ultimoContrato->fecha_vencimiento;
		$fechaVencimiento = (clone $fechaInicio)->addDays(30);
		return Contrato::create([
			'empresa_id' => $empresa_id,
			'plan_id' => $plan->id,
			'estado' => static::$CONTRATO_ENESPERA,
			'plan_precio' => $plan->precio,
			'pedidos_total' => $plan->cantidad_pedidos,
			'fecha_inicio' => $fechaInicio,
			'fecha_vencimiento' => $fechaVencimiento
		]);
	}


	/*
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
	*/
}
