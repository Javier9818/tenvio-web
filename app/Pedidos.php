<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\PedidosUsers;
use App\Contrato;

//PARA MEJORAR : campo comentario aplica para chatbot y para rechazar pedido

class Pedidos extends Model
{
	protected $table = 'pedidos';
	protected $fillable = [
		'id',
		'empresa_id',
		'estado',
		'estadoPago',///
		'id_tipopago',///
		'id_regpago',///
		'comentario',
		'latitud',
		'longitud',
		'direccion',
		'meta_latitud',
		'meta_longitud',
		'user_id',
		'tipo_id',
		'created_at',
		'updated_at',
		'monto'
	];

	protected $casts = [
		'updated_at' => 'datetime:d/m/Y h:i a',
		'fecha_entrega' => 'datetime:d/m/Y h:i a'
	];

	public static $PAGO_CULQI = 5;

	public static function listar($empresa_id, $tipo, $fecha){
		$where = array('pedidos.empresa_id' => $empresa_id);
		if ($tipo == 'Todo'){
			$where['pedidos.estado'] = 'Pendiente';
		}
		if ($tipo == 'Recepcion'){
			$where['pedidos.estado'] = 'Aceptado';
			$where['pedidos.tipo_id'] = 2;
		}
		if ($tipo == 'Delivery'){
			$where['pedidos.estado'] = 'Aceptado';
			$where['pedidos.tipo_id'] = 1;
		}
		if ($tipo == 'Entregado'){
			$where['pedidos.estado'] = 'Entregado';
		}
		$bul = false;
		if ($fecha != 'Hoy'){
			$bul = true;
		}
		else{
			$fecha = '';
		}
		return static::consultaPedido($where, $bul, $fecha);
	}
	public static function obtenerPedido($id_pedido){
		$where = array('pedidos.id' => $id_pedido);
		return static::consultaPedido($where, false, '')->first();
	}
	public static function consultaPedido($where, $bul, $fecha){
		$select = array(
			'pedidos.id as idpedido',
			DB::raw("GROUP_CONCAT(dp.producto_id) as ids"),
			DB::raw("GROUP_CONCAT(dp.cantidad) as cantidades"),
			'estadoPago',
			'id_tipopago',
			'tp.nombre as tipopago_nombre',
			'id_regpago',
			'comentario'
		);
		if ($bul){
			$select[] = DB::raw("sum(dp.precio_unit * dp.cantidad) as monto");
			$select[] = 'pedidos.updated_at as fecha_entrega';
		}
		else{
			$select[] = 'personas.id as idusuario';
			$select[] = DB::raw("CONCAT(personas.appaterno, ' ', personas.apmaterno, ', ', personas.nombres) as nombres");
			$select[] = 'personas.celular';
			$select[] = 'pedidos.direccion';
			$select[] = 'te.nombre as tipo_entrega';
		}
		return Pedidos::whereRaw('pedidos.updated_at like ?', $fecha.'%')->where($where)
			->select($select)
			->join('detalle_pedidos as dp', 'dp.pedido_id', '=', 'pedidos.id')
			->join('users as u', 'u.id', '=', 'pedidos.user_id')
			->join('personas as personas', 'personas.id', '=', 'u.persona_id')
			->join('tipo_entregas as te', 'te.id', '=', 'pedidos.tipo_id')
			->join('tipopago as tp', 'tp.id', '=', 'pedidos.id_tipopago')
			->groupBy('pedidos.id')
			->get();
	}
	public static function entregar($idpedido, $empresa_id){
		DB::beginTransaction();
		try {
			$pedidos = Pedidos::where('id', $idpedido)
				->update([
					'estado' => 'ENTREGADO'
				]);
			Contrato::sumarPedidoEntregado($empresa_id);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			return false;
		}
		return $pedidos;
	}
	public static function aceptar($idpedido){
		return Pedidos::where('id', $idpedido)
			->update([
				'estado' => 'ACEPTADO'
			]);
	}
	public static function cancelar($idpedido, $comentario){
		return Pedidos::where('id', $idpedido)
			->update([
				'estado' => 'CANCELADO',
				'comentario' => $comentario
			]);
	}
	public static function cancelarvarios($id_pedidos, $comentario){
		return Pedidos::whereIn('id', $id_pedidos)
			->update([
				'estado' => 'CANCELADO',
				'comentario' => $comentario
			]);
	}

	public static function listarEmpleados($empresa_id){
		$where = array(
			'ue.empresa_id' => $empresa_id,
			'permiso_id' => 5
		);
		return DB::table('personas')
			->where($where)
			->select(
				'personas.id as id',
				DB::raw("CONCAT(personas.appaterno, ' ', personas.apmaterno, ', ', personas.nombres) as nombres")
				//'personas.dni',
				//'personas.celular'
			)
			->join('users as u', 'u.persona_id', '=', 'personas.id')
			->join('users_empresas as ue', 'ue.user_id', '=', 'u.id')
			->join('permiso_user as pu', 'pu.user_id', '=', 'ue.user_id')
			->get();
	}
	public static function asignar($pedidos, $idrepartidor){
		$asignacion = Asignacion::create([
			'user_id' => $idrepartidor
		]);
		foreach ($pedidos as $item) {
			Pedidos::where('id', $item['idpedido'])->update([
				'estado' => 'ENVIANDO'
			]);
			//ASIGNAR TODOS LOS PEDIDOS QUE LLEGAN AQUI
			PedidosUsers::create([
				'pedidos_id' => $item['idpedido'],
				'asignacion_id' => $asignacion->id
			]);
		}
		return $asignacion;
	}


	public static function devolverPago($idpedido){
		return Pedidos::where('id', $idpedido)
			->update([
				'estadoPAGO' => 'DEVUELTO'
			]);
	}

	public static function getOrdersByEmployeeId($id){
		$pedidos = DB::table('pedidos')
		->join("pedidos_users", "pedidos_users.pedidos_id", "pedidos.id")
		->join("asignacion", "asignacion.id", "pedidos_users.asignacion_id")
		->join("users", "users.id", "=", "pedidos.user_id")
		->join("personas", "personas.id", "=", "users.persona_id")
		->join("detalle_pedidos", "detalle_pedidos.pedido_id", "=", "pedidos.id")
		->selectRaw('pedidos.id, CONCAT(personas.appaterno ," ", personas.apmaterno ," ",personas.nombres) as cliente,
		pedidos.direccion, pedidos.monto, pedidos.latitud, pedidos.longitud, personas.celular')
		->whereRaw("asignacion.user_id= ? and pedidos.estado ='ENVIANDO'", [$id])
		->groupBy("pedidos.id")
		->get();

		return $pedidos;
	}
}
