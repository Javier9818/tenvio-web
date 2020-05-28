<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    protected $table = 'detalle_pedidos';
    protected $fillable = [
		'producto_id',
		'pedido_id',
		'cantidad',
		'created_at',
		'updated_at'
	];
}
