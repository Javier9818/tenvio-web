<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
		'id',
		'nombre',
		'descripcion',
		'foto',
		'precio',
		'categorias_menu_id',
		'empresa_id',
		'estado',
		'usuario_puede_ver',
		'created_at',
		'updated_at'
	];
	public static function puedeEliminarse($id){
		//valida si dicha categoria tiene productos a su nombre con estado 1
		return Producto::where(['productos.id' => $id])
			->join('detalle_pedidos', 'productos.id', '=', 'detalle_pedidos.producto_id')
			->count() == 0;
	}
	public static function listar($empresa_id){
		return Producto::where(['productos.estado' => '1', 'productos.empresa_id' => $empresa_id])
			->select('productos.id', 'productos.nombre', 'productos.descripcion',
				'productos.precio', 'categorias_menus.id as categorias_menu_id',
				'categorias_menus.descripcion as categoria', 'productos.foto as foto')
			->join('categorias_menus', 'productos.categorias_menu_id', '=', 'categorias_menus.id')
			->get();
	}
	public static function eliminar($id){
		return Producto::where('id', $id)
			->update([
				'estado' => 0
			]);
	}
	public static function editar($id, $nombre, $descripcion, $precio, $foto, $categorias_menu_id){
		return Producto::where('id', $id)
			->update([
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'foto' => $foto,
				'categorias_menu_id' => $categorias_menu_id
			]);
	}
	public static function registrar($nombre, $descripcion, $precio, $foto, $categorias_menu_id, $empresa_id){
		return Producto::create([
			'nombre' => $nombre,
			'descripcion' => $descripcion,
			'precio' => $precio,
			'foto' => $foto,
			'categorias_menu_id' => $categorias_menu_id,
			'empresa_id' => $empresa_id,
			'estado' => 1,
			'usuario_puede_ver' => 1
		]);
	}
}
/*
	Schema::create('productos', function (Blueprint $table) {
		$table->id();
		$table->string('nombre', 80);
		$table->string('descripcion')->nullable();
		$table->string('foto', 100)->nullable();
		$table->double('precio');
		$table->integer('categorias_menu_id');
		$table->integer('empresa_id');
		$table->timestamps();
	});
*/
