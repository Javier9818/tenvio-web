<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	protected $table = 'plan';
	protected $fillable = [
		'id',
		'nombre',
		'descripcion',
		'precio',
		'cantidad_pedidos',
		'tipo',
		'created_at',
		'updated_at'
	];
	public static $PLAN_PLAN = 'PLAN';
	public static $PLAN_EXTENSION = 'EXTENSIÓN';

	public static function listaExtensiones(){
		return Plan::where(['tipo' => static::$PLAN_EXTENSION])->whereRaw('precio != 0')
			->select('id',
				'nombre',
				'descripcion',
				'precio',
				'cantidad_pedidos')
			->get();
	}

	public static function listaPlanes(){
		return Plan::where(['tipo' => static::$PLAN_PLAN])->whereRaw('precio != 0')
			->select('id',
				'nombre',
				'descripcion',
				'precio',
				'cantidad_pedidos')
			->get();
	}

	public static function getPlan($plan_id){
		return Plan::find($plan_id);
	}
}
