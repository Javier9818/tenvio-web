<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'persona_id', 'email', 'isAdmin', 'isCustomer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','isAdmin', 'isCustomer', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function setImagen($data, $actual = false){
        if($data){
            if($actual){
                Storage::disk('public')->delete("images/fotosPerfil/$actual");
            }
            $imageName=Str::random(20).'.jpg';
            $imagen=Image::make($data)->encode('jpg',90);
            $imagen->resize(200,200,function($constraint){
                $constraint->upsize();
            });
            Storage::disk('public')->put("images/fotosPerfil/$imageName",$imagen->stream());
            return $imageName;
        }else{
            return false;
        }
    }

}
