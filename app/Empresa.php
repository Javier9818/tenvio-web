<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Empresa extends Model
{
    protected $fillable = ['id', 'ruc', 'nombre', 'descripcion', 'telefono', 'celular', 'direccion', 'foto', 'distrito','ciudad', 'categoria_id', 'created_at', 'updated_at'];

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
}
