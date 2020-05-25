<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $fillable = ['id', 'nombre','distrito_id'];
    protected $table = 'ciudad';
}
