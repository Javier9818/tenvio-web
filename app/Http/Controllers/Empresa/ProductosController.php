<?php
namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExtrasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Producto;

class ProductosController extends Controller
{
	public function vista(Request $request){
		return view('admin.menu.productos');
	}
	/*
    public function fn($funcion='', Request $request){
		if ($funcion == 'listar') return $this->listar($request);
		else if ($funcion == 'setupddel') return $this->setupddel($request);
		else return view('admin.menu.productos');
    }
	*/

	static function listar(Request $request){
		$empresa_id = Session::get('empresa');////////////////////////////////////
		$productos = [
			'productos' => Producto::listar($empresa_id),
			'rutaImagenes' => ExtrasController::$rutaFotosProductos
		];
		return response()->json($productos, 200);
	}

	static function setupddel(Request $request){
		$id = $request->get('producto')['id'];
		$nombre = $request->get('producto')['nombre'];
		$descripcion = $request->get('producto')['descripcion'];
		$precio = $request->get('producto')['precio'];
		$categorias_menu_id = $request->get('producto')['categorias_menu_id'];
		$usuario_puede_ver = $request->get('producto')['usuario_puede_ver'];
		$foto = $request->get('producto')['foto']??'';
		$fotosubida = $request->get('producto')['fotosubida']??[];
		$sesubiofoto = false;
		if (count($fotosubida) == 1){
			$sesubiofoto = true;
			$fotosubida = $fotosubida[0]['upload']['data'];
		}
		else
			$fotosubida = $foto;
		$eliminar = $request->get('eliminar');
		if ($eliminar == true){
			if(!Producto::puedeEliminarse($id))
				return array('mensaje' => 'El producto no puede eliminarse debido a que se registra en un pedido, pero usted puede ocultar el producto al público');
			Producto::eliminar($id);
		}
		else{
			$empresa_id = Session::get('empresa');////////////////////////////////////
			if ($id == 0)
				Producto::registrar($nombre, $descripcion, $precio, $fotosubida, $categorias_menu_id, $empresa_id);
			else
				Producto::editar($id, $nombre, $descripcion, $precio, $fotosubida, $categorias_menu_id, $usuario_puede_ver);
			if ($sesubiofoto == true)
				ExtrasController::moverFotoProducto($fotosubida);
		}
		//return 4949;
		//return abort(409);
		return response()->json(true, 200);
	}
}
