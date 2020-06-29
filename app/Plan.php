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

	public static function listaExtensiones(){
		return Plan::where(['tipo' => 'EXTENSIÓN'])->whereRaw('precio != 0')
			->select('id',
				'nombre',
				'descripcion',
				'precio',
				'cantidad_pedidos')
			->get();
	}

	public static function listaPlanes(){
		return Plan::where(['tipo' => 'PLAN'])->whereRaw('precio != 0')
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
