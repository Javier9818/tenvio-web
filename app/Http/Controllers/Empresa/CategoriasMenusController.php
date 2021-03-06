<?php
namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\CategoriaMenu;

class CategoriasMenusController extends Controller
{
	public function vista(Request $request){
		return view('admin.menu.categorias');
	}
/*
    public function fn($funcion='', Request $request){
		if ($funcion == 'listar') return $this->listar($request);
		else if ($funcion == 'setupddel') return $this->setupddel($request);
		else if ($funcion == 'listarvselect') return $this->listarvselect($request);
		else return view('admin.menu.categorias');
    }
*/
	static function listarvselect(Request $request){
		$empresa_id = session('empresa');////////////////////////////////////
		$categorias = CategoriaMenu::listarvselect($empresa_id);
		return response()->json($categorias, 200);
	}

	static function listar(Request $request){
		$empresa_id = session('empresa');////////////////////////////////////
		$categorias = CategoriaMenu::listar($empresa_id);
		return response()->json($categorias, 200);
	}

	static function setupddel(Request $request){
		$id = $request->get('categoria')['id'];
		$descripcion = $request->get('categoria')['descripcion'];
		$eliminar = $request->get('eliminar');
		if ($eliminar == true){
			if(!CategoriaMenu::puedeEliminarse($id))
				return array('mensaje' => 'La categoría registra productos, elimine los productos de estas categorías e intente nuevamente');
			CategoriaMenu::eliminar($id);
		}
		else{
			$empresa_id = session('empresa');////////////////////////////////////
			if ($id == 0)
				CategoriaMenu::registrar($descripcion, $empresa_id);
				else
				CategoriaMenu::editar($id, $descripcion);
		}
		return response()->json(true, 200);
	}

}
