<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNegocio extends Model
{
    protected $table = 'tipo_negocio';
    protected $fillable = ['id', 'descripcion'];
}
