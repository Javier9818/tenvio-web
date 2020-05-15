<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class generalController extends Controller
{
    public function roles()
    {
        $roles = DB::select('select id as value, descripcion as text from permisos');
        return response()->json(["roles" => $roles], 200);
    }

    public function validateUsername($username){
        $user = DB::select('select * from users where username = ?', [$username]);
        if(count($user) > 0 )
            return response()->json(["message" => true]);
        else
            return response()->json(["message" => false]);
    }
}
