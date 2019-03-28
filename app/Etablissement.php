<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $table = 'etablissements';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected  $attributes = [
        'id',  'universite_id', 'intitule', 'abrev', 'gid'
    ];



    public function __construct() {
        parent::__construct();

    }

    public static function querySelect(  ){

        return "  SELECT etablissements.* FROM etablissements  ";
    }

    public static function queryWhere(  ){

        return "  WHERE etablissements.id IS NOT NULL ";
    }

    public static function queryGroup()
    {
        return "  ";

    }



    public function users(){
        return $this->hasMany('App\User');
    }

    // 01.user -> +.etab

    public function universite(){
        return $this->belongsTo('App\Universite');
    }



}


