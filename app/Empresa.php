<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Empresa extends Model
{
    protected $fillable = [
        'id',
        'estado',
        'ruc',
        'nombre',
        'descripcion',
        'telefono',
        'celular',
        'direccion',
        'foto',
        'nombre_unico',
        'ciudad_id',
        'categoria_id',
        'created_at',
        'updated_at',
        'latitud',
        'longitud',
        'token_fb',
        'id_fb'
    ];

    public static function setImagen($data, $actual = false){
        if($data){
            if($actual){
                Storage::disk('public')->delete("images/perfilEmpresa/$actual");
            }
            $imageName=Str::random(20).'.jpg';
            $imagen=Image::make($data)->encode('jpg',90);
            // $imagen->resize(530,470,function($constraint){
            //     $constraint->upsize();
            // });
            Storage::disk('public')->put("images/perfilEmpresa/$imageName",$imagen->stream());
            return $imageName;
        }else{
            return false;
        }
    }

    public static function deleteImage($foto){
        if($foto){
            Storage::disk('public')->delete("images/artesania/$foto");
            return true;
        }else{
            return false;
        }
    }

    public static function crearNombreUnico($nombre){
        $empresas = DB::table('empresas')->where('nombre_unico', '=', $nombre)->get();
        if(count($empresas) > 0){
            return $nombre.(count($empresas) + 1);
        }else{
            return $nombre;
        }
    }

    public static function listNearCompanies($latitud, $longitud, $maxRadio){
        $lat = floatval($latitud);
        $lon = floatval($longitud);
        return DB::table('empresas')
                ->join('categoria_empresa', 'categoria_empresa.empresa_id', '=', 'empresas.id')
                ->join('categorias', 'categorias.id', '=', 'categoria_empresa.categoria_id')
                ->selectRaw('empresas.*, GROUP_CONCAT(categoria_empresa.categoria_id) as categorias,
                 GROUP_CONCAT(categorias.tipo_negocio_id) as tipos_negocio')
                ->whereRaw('f_distance(empresas.latitud, empresas.longitud,?,?) < ?', [$lat,$lon,$maxRadio])
                ->groupBy('empresas.id')
                ->get();
    }
}
