<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;

class ProductosController extends Controller
{
    public function fn($funcion='', Request $request){
		if ($funcion == 'listar') return $this->listar($request);
		else if ($funcion == 'setupddel') return $this->setupddel($request);
		//else if ($funcion == 'setupddel') return $this->setupddel($request);
		else return view('admin.menu.productos');
    }

	static function listar(Request $request){
		$empresa_id = 1;////////////////////////////////////
		$productos = Producto::listar($empresa_id);
		return response()->json($productos, 200);
	}

	static function setupddel(Request $request){
		$id = $request->get('producto')['id'];
		$nombre = $request->get('producto')['nombre'];
		$descripcion = $request->get('producto')['descripcion'];
		$precio = $request->get('producto')['precio'];
		$categorias_menu_id = $request->get('producto')['categorias_menu_id'];
		$eliminar = $request->get('eliminar');
		if ($eliminar == true){
			Producto::eliminar($id);
		}
		else{
			$empresa_id = 1;////////////////////////////////////
			if ($id == 0)
				Producto::registrar($nombre, $descripcion, $precio, $categorias_menu_id, $empresa_id);
			else
				Producto::editar($id, $nombre, $descripcion, $precio, $categorias_menu_id);
		}
		return response()->json(true, 200);
	}

	static function funcion(Request $request){
	}
}
