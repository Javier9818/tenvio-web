<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class ExtrasController extends Controller
{
	private static $rutaArchivosTemporal = 'img/temp/';
	//public static $rutaFotosProductos = 'img/productos/';
	public static $rutaFotosProductos = 'storage/imgproductos/';

    public function fn($funcion='', Request $request){
		if ($funcion == 'addArchivo') return $this->addArchivo($request);
		//else if ($funcion == 'addArchivo') return $this->addArchivo($request);
		else return "";
    }
	public static function moverFotoProducto($fotosubida){
		Storage::move(
			'/public/temp/'.$fotosubida,
			'/public/imgproductos/'.$fotosubida
		);
		/*
		copy(
			static::$rutaArchivosTemporal.$fotosubida,
			static::$rutaFotosProductos.$fotosubida
		);
		unlink(static::$rutaArchivosTemporal.$fotosubida);
		*/
	}

	static function addArchivo(Request $request){
		if(count($_FILES) == 0)
			return;
		$nombreArchivo = $_FILES["file"]['name'];
		$extension = explode(".", $nombreArchivo);
		$extension = $extension[count($extension) - 1];
		$nombreArchivoFinal =
		date("y"). //años
		date("m"). //mes
		date("d"). //dia
		date("H"). //hora 24h
		date("i"). //minutos
		date("s"). //segundos
		date("_").
		substr(microtime(),2,4).
		'.'.$extension;
		$rutaArchivoSubido = static::$rutaArchivosTemporal.$nombreArchivoFinal;
		//move_uploaded_file($_FILES["file"]['tmp_name'], $rutaArchivoSubido);
		Storage::disk('temp')->put($nombreArchivoFinal, File::get($_FILES["file"]['tmp_name']));
		return $nombreArchivoFinal;
		//return $nombreArchivoFinal.'||'.$extension.'||'.$nombreArchivo;
	}

	static function funcion(Request $request){
	}
}
