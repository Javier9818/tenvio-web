<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $fillable = ['id', 'descripcion', 'tipo_negocio_id','state','created_at','icon'];
    protected $table = 'categorias';

    public static  function _GET($request)
    {
        return Categoria::where('tipo_negocio_id', $request->get('id'))
            ->select('id', 'descripcion','state','created_at','icon')
            ->get();
    }
    public static function _Save($request)
    {
        return Categoria::create(
            [
                'descripcion'=>$request->get('descripcion'),
                'state'=>1,
                'icon'=>$request->get('icon'),
                'tipo_negocio_id'=>$request->get('tipo_negocio_id')
            ]
        );
    }
    public static  function _Update($request)
    {
        return Categoria::where('id', $request->get('id'))
        ->update(
            [
                'descripcion'=>$request->get('descripcion'),
                'icon'=>$request->get('icon')
            ]
        );
    }
    public static  function _Delete($request)
    {
        return Categoria::where('id', $request->get('id'))
			->update([
				'state' => $request->get('state')
			]);
    }

    public static function getCategoryByTypeBussiness($id){
        $categorias = DB::table('categorias')->selectRaw('id as value, descripcion as text')
            ->where('tipo_negocio_id','=',$id)->get();
        return $categorias;
    }
}


