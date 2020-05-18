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
	public static function listarvselect($empresa_id){
		return CategoriaMenu::where(['estado' => '1'])
			->select('id as value', 'descripcion as text')
			->get();
	}
	public static function listar($empresa_id){
		return CategoriaMenu::where(['estado' => '1'])
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
