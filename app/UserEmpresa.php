<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEmpresa extends Model
{
    protected $table = 'users_empresas';
    protected $fillable = ['cargo_id', 'user_id', 'empresa_id'];
}
