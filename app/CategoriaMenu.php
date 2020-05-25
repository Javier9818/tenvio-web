<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CategoriaMenu extends Model
{
    protected $table = 'categorias_menus';
    protected $fillable = [
		'id',
		'descripcion',
		'empresa_id',
		'estado'
	];
	public static function puedeEliminarse($id){
		//valida si dicha categoria tiene productos a su nombre con estado 1
		return count(CategoriaMenu::where(['productos.estado' => '1', 'categorias_menus.id' => $id])
			->join('productos', 'productos.categorias_menu_id', '=', 'categorias_menus.id')
			->get()) == 0;
	}
	public static function listarvselect($empresa_id){
		return CategoriaMenu::where(['estado' => '1', 'empresa_id' => $empresa_id])
			->select('id as value', 'descripcion as text')
			->get();
	}
	public static function listar($empresa_id){
		return CategoriaMenu::where(['estado' => '1', 'empresa_id' => $empresa_id])
			->select('id', 'descripcion')
			->get();
	}
	public static function eliminar($id){
		return CategoriaMenu::where('id', $id)
			->update([
				'estado' => 0
			]);
	}
	public static function editar($id, $descripcion){
		return CategoriaMenu::where('id', $id)
			->update([
				'descripcion' => $descripcion
			]);
	}
	public static function registrar($descripcion, $empresa_id){
		return CategoriaMenu::create([
			'descripcion' => $descripcion,
			'empresa_id' => $empresa_id,
			'estado' => 1,
		]);
	}
}
/*
Schema::create('categorias_menus', function (Blueprint $table) {
	$table->id();
	$table->string('descripcion');
	$table->integer('empresa_id');
	$table->timestamps();
});
*/
