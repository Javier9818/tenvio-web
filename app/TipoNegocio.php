<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class TipoNegocio extends Model
{
    protected $table = 'tipo_negocio';
    protected $fillable = ['id', 'descripcion','state','created_at','updated_at'];
    
    public static function _Save($request)
    {   
        return TipoNegocio::create(
            [ 
                'descripcion'=>$request->get('descripcion'),
                'state'=>1
            ]
        );
    }
    public static  function _Update($request)
    {
        return TipoNegocio::where('id', $request->get('id'))
        ->update(
            [
                'descripcion'=>$request->get('descripcion')
            ]
        );
    }
    public static  function _Delete($request)
    {        
        return TipoNegocio::where('id', $request->get('id'))
			->update([
				'state' => $request->get('state')
			]);
    }
}
