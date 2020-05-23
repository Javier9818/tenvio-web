<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CategoriaMenu;
use Illuminate\Support\Facades\Session;

class CategoriasMenusController extends Controller
{
    public function fn($funcion='', Request $request){
		if ($funcion == 'listar') return $this->listar($request);
		else if ($funcion == 'setupddel') return $this->setupddel($request);
		else if ($funcion == 'listarvselect') return $this->listarvselect($request);
		else return view('admin.menu.categorias',["empresa" => Session::get('empresa')]);
    }

	static function listarvselect(Request $request){
		$empresa_id = 1;////////////////////////////////////
		$categorias = CategoriaMenu::listarvselect($empresa_id);
		return response()->json($categorias, 200);
	}

	static function listar(Request $request){
		$empresa_id = 1;////////////////////////////////////
		$categorias = CategoriaMenu::listar($empresa_id);
		return response()->json($categorias, 200);
	}

	static function setupddel(Request $request){
		$id = $request->get('categoria')['id'];
		$descripcion = $request->get('categoria')['descripcion'];
		$eliminar = $request->get('eliminar');
		if ($eliminar == true){
			CategoriaMenu::eliminar($id);
		}
		else{
			$empresa_id = 1;////////////////////////////////////
			if ($id == 0)
				CategoriaMenu::registrar($descripcion, $empresa_id);
				else
				CategoriaMenu::editar($id, $descripcion);
		}
		return response()->json(true, 200);
	}

	static function funcion(Request $request){
	}
}
