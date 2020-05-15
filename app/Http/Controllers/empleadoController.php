<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empleadoController extends Controller
{
    public function setEmpleado(Request $request)
    {
        $persona = Persona::create([
            "nombres" => $request->nombres,
            "appaterno" => $request->appaterno,
            "apmaterno" => $request->apmaterno,
            "celular" => $request->celular,
            "direccion" => $request->direccion,
            "dni" => $request->direccion,
            "email" => $request->direccion,
        ]);

        $user = User::create([
            "username" => $request->username,
            "password" => Hash::make($request->dni),
            "persona_id" => $persona->id
        ]);

        DB::insert('insert into users_empresas (user_id, empresa_id) values (?, ?)', [$user->id, $request->empresa]);

        foreach ($request->roles as $key => $value) {
            DB::insert('insert into permisos_users (permiso_id, user_id) values (?, ?)', [$value, $user->id]);
        }

        return response()->json([ "id" => $user->id ], 200);
    }
}
