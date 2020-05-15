<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombres', 'appaterno', 'apmaterno', 'celular', 'direccion', 'created_at', 'updated_at'];
}
