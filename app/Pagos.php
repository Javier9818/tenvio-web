<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
	protected $table = 'pagos';
	protected $fillable = [
		'id',
		'empresa_id',
		'monto',
		'estado',
		'created_at',
		'updated_at'
	];
}
