<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['id', 'ruc', 'nombre', 'descripcion', 'telefono', 'celular', 'direccion', 'foto', 'distrito','ciudad', 'categoria_id', 'created_at', 'updated_at'];
}
