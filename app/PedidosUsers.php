<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class PedidosUsers extends Model
{
    protected $table = 'pedidos_users';
    protected $fillable = [
		'id',
        'pedidos_id',
        'asignacion_id'
    ];
    public $timestamps = false;
}
