<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use  Illuminate\Contracts\Auth\MustVerifyEmail ;

class User extends Authenticatable  implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cin',  'name', 'prenom','datenaissance','email', 'password','universite_id','etablissement_id', 'profile'
        ,'grade','addresse','numtel','type','bio', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 01.user -> +.univ
    public function universite(){
        return $this->belongsTo('App\Universite');
    }

    // 01.user -> +.etab

//    public function etablissement(){
//        return $this->belongsTo('App\Etablissement');
//    }
}
