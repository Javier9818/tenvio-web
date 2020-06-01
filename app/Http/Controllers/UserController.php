<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function updateFoto(Request $request, $user){
        $user = User::find($user);
        $image = substr($request->image, strpos($request->image, ',') + 1);
        $image = base64_decode($image);
        //return $image;
        if($user->foto != '') $res = User::setImagen($image, $user->foto);
        else $res = User::setImagen($image);

        if($res !== false){
            $user->foto = $res;
            $user->save();
            return response()->json(["message" => "Actualización exitosa", "foto" => $res], 200);
        }else{
            return response()->json(["message" => "Error en actualización"], 500);
        }

    }

    public function getUser(){
        $user = DB::select('select u.id, foto, username, email, nombres, appaterno, apmaterno, celular, direccion, dni from users u
                inner join personas p on p.id = u.persona_id
                where u.id = ?', [Auth::id()]);
        return view('auth.profile', ["user" => $user[0]]);
    }

    public function updateUser(Request $request){
        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        $person = Persona::find($user->persona_id);
        $person->nombres = $request->nombres;
        $person->appaterno = $request->appaterno;
        $person->apmaterno = $request->apmaterno;
        $person->direccion = $request->direccion;
        $person->celular = $request->celular;
        $person->dni = $request->dni;
        $person->save();

        return response()->json(["message"=>'Datos actualizados con exito'], 200);
    }

    public function updatePassword(Request $request){
        $user = DB::select('select password from users where id = ?', [$request->id]);
        if(Hash::check($request->claveActual, $user[0]->password)){
            DB::update('update users set password = ? where id = ?', [Hash::make($request->claveNueva), $request->id]);
            return response()->json(["message"=>'Datos actualizados con exito'], 200);
        }else{
            return response()->json(["error"=>'Las contraseñas no coinciden'], 200);
        }
    }

    public function setUser(Request $request){
        $persona = Persona::create([
            "nombres" => $request->nombres,
            "appaterno" => $request->appaterno,
            "apmaterno" => $request->apmaterno,
            "celular" => $request->celular,
            "direccion" => null,
            "dni" => $request->dni,
        ]);

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->dni),
            "persona_id" => $persona->id,
            "isCustomer" => false,
            "isAdmin"=> false
        ]);
    }

}
