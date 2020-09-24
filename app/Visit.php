<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Visit extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'visits_webpage';
    protected $fillable = ['id', 'navigation'];
}
