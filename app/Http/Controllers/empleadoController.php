<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empleadoController extends Controller
{
    public function setEmpleado(Request $request){
        $persona = Persona::create([
            "nombres" => $request->nombres,
            "appaterno" => $request->appaterno,
            "apmaterno" => $request->apmaterno,
            "celular" => $request->celular,
            "direccion" => $request->direccion,
            "dni" => $request->dni,
        ]);

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->dni),
            "persona_id" => $persona->id,
            "persona_id" => $persona->id,
            "isCustomer" => true
        ]);

        DB::insert('insert into users_empresas (user_id, empresa_id, cargo_id) values (?, ?, ?)', [$user->id, $request->empresa, $request->cargo]);

        DB::insert('insert into permiso_user (permiso_id, user_id) values (?, ?)', [7, $user->id]);
        foreach ($request->roles as $key => $value) {
            DB::insert('insert into permiso_user (permiso_id, user_id) values (?, ?)', [$value, $user->id]);
        }

        return response()->json([ "id" => $user->id ], 200);
    }

    public function updateEmpleado(Request $request){

        $persona = Persona::find($request->persona_id);
        $persona->nombres = $request->nombres;
        $persona->appaterno = $request->appaterno;
        $persona->apmaterno = $request->apmaterno;
        $persona->celular = $request->celular;
        $persona->direccion = $request->direccion;
        $persona->dni = $request->dni;
        $persona->save();

        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        DB::update('update users_empresas set cargo_id = ? where user_id = ?', [$request->cargo, $request->user_id]);
        DB::delete('delete from permiso_user where user_id = ?', [$request->user_id]);

        foreach ($request->roles as $key => $value) {
            DB::insert('insert into permiso_user (permiso_id, user_id) values (?, ?)', [$value, $request->user_id]);
        }

        return response()->json([ "id" => $user->id ], 200);
    }

    public function listByEmpresa($empresa){
        $empleados = DB::select('select *, c.descripcion as cargo, u.id as user_id from users u
                    inner join users_empresas ue on u.id = ue.user_id
                    inner join personas p on p.id = u.persona_id
                    inner join cargos c on c.id = ue.cargo_id
                    where ue.empresa_id = ?', [$empresa]);
        return response()->json(["empleados" => $empleados], 200);
    }

    public function edit($id){
        $empleado = DB::select('select *, c.id as cargo from users u
                    inner join users_empresas ue on u.id = ue.user_id
                    inner join personas p on p.id = u.persona_id
                    inner join cargos c on c.id = ue.cargo_id
                    where u.id = ?', [$id]);
        $empleado[0]->password = '';

        $roles = DB::select('select permiso_id as id from permiso_user where user_id = ?', [$id]);
        foreach ($roles as $key => $value) {
            $rols[$key] = $value->id;
        }

        return view('admin.negocio.editEmpleado', ["empleado" => $empleado[0], "roles" => $rols]);
    }
}
