<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = ['id', 'estado','empresa_id', 'plan_id', 'plan_monto','fecha_vencimiento', 'pago_id', 'created_at', 'updated_at'];
}
