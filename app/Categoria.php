<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['id', 'descripcion', 'tipo_negocio_id'];
    protected $table = 'categorias';
}
