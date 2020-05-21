<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtrasController extends Controller
{
	private static $rutaArchivosTemporal = 'img/temp/';
	public static $rutaFotosProductos = 'img/productos/';

    public function fn($funcion='', Request $request){
		if ($funcion == 'addArchivo') return $this->addArchivo($request);
		//else if ($funcion == 'addArchivo') return $this->addArchivo($request);
		else return "";
    }
	public static function moverFoto($fotosubida){
		copy(
			static::$rutaArchivosTemporal.$fotosubida,
			static::$rutaFotosProductos.$fotosubida
		);
		unlink(static::$rutaArchivosTemporal.$fotosubida);
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
		//el archivo lo muevo a temp
		$rutaArchivoSubido = static::$rutaArchivosTemporal.$nombreArchivoFinal;
		move_uploaded_file($_FILES["file"]['tmp_name'], $rutaArchivoSubido);
		return $nombreArchivoFinal;
		//return $nombreArchivoFinal.'||'.$extension.'||'.$nombreArchivo;
	}

	static function funcion(Request $request){
	}
}
