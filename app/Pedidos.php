<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
		'id',
		'empresa_id',
		'estado',
		'comentario',
		'latitud',
		'longitud',
		'meta_latitud',
		'meta_longitud',
		'user_id',
		'tipo_id',
		'created_at',
		'updated_at'
	];
	public static function listar($empresa_id){
		return Pedidos::where(['pedidos.empresa_id' => $empresa_id])
			->select(
				'pedidos.id as idpedido',
				DB::raw("GROUP_CONCAT(dp.producto_id) as ids"),
				DB::raw("GROUP_CONCAT(dp.cantidad) as cantidades"),
				'personas.id as idusuario',
				DB::raw("CONCAT(personas.appaterno, ' ', personas.apmaterno, ', ', personas.nombres) as nombres"),
				//'personas.nombres',
				//'personas.appaterno',
				//'personas.apmaterno',
				'personas.celular',
				'personas.direccion'
			)
			->join('detalle_pedidos as dp', 'dp.pedido_id', '=', 'pedidos.id')
			->join('users as u', 'u.id', '=', 'pedidos.user_id')
			->join('personas as personas', 'personas.id', '=', 'u.persona_id')
			->groupBy('pedidos.id')
			->get();
	}
	public static function aceptar($idpedido){
		return Pedidos::where('id', $idpedido)
			->update([
				'estado' => 'Aceptado'
			]);
	}
	public static function anular($idpedido, $comentario){
		return Pedidos::where('id', $idpedido)
			->update([
				'estado' => 'Anulado',
				'comentario' => $comentario
			]);
	}
}
/*
Laravel : Syntax error or access violation: 1055 Error
https://stackoverflow.com/questions/40917189/laravel-syntax-error-or-access-violation-1055-error
-------------- lista de pedidos, datos del pedido y del usuario
select
	pe.id as idpedido,
	GROUP_CONCAT(dp.producto_id) AS ids,
	GROUP_CONCAT(dp.cantidad) AS cantidades,
	p.id as idusuario, p.nombres, p.appaterno, p.apmaterno, p.celular, p.direccion
from pedidos pe
join detalle_pedidos dp on pe.id = dp.pedido_id
join users u on u.id = pe.user_id
join personas p on p.id = u.persona_id
where pe.empresa_id = 1
group by(pe.id)
;

-------------- pedir productos de todos los pedidos de una empresa de manera separada
select distinct pr.id, pr.nombre, pr.descripcion, pr.foto, pr.precio, cm.descripcion
from productos pr
join categorias_menus cm on cm.id = pr.categorias_menu_id
-- join detalle_pedidos dp on dp.producto_id = pr.id
-- join pedidos pe on pe.id = dp.pedido_id
where pr.estado = 1 and pr.empresa_id = 1
;
*/
