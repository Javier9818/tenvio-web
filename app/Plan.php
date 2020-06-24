<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['id', 'nombre', 'descripcion', 'precio','created_at', 'updated_at'];
    protected $table = 'plan';
}
