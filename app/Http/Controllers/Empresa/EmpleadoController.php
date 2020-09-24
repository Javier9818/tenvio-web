<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\User;

class EmpleadoController extends Controller
{

    public function showEmployees(){
        return view('admin.negocio.empleados', ["empresa" => session('empresa')]);
    }

    public function showNewEmployee(){
        return view('admin.negocio.crearEmpleado', ["empresa" => session('empresa')]);
    }

    public function editEmployee($id){
        $empleado = User::getEmployeeByUserId($id);
        $empleado->password = '';
        $roles = User::getRolesByUserId($id);
        foreach ($roles as $key => $value) {
            $rols[$key] = $value->id;
        }

        return view('admin.negocio.editEmpleado', ["empleado" => $empleado, "roles" => $rols]);
    }

}
