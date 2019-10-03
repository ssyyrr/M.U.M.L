<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Universite extends Model
{
    protected $table = 'universites';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected  $fillable = [
        'id',  'intitule', 'abrev'
    ];


    public function __construct() {
        parent::__construct();

    }

/*     public static function querySelect(  ){

        return "  SELECT universites.* FROM universites  ";
    }

    public static function queryWhere(  ){

        return "  WHERE universite.iduniv IS NOT NULL ";
    }

    public static function queryGroup(){
        return "  ";
    }
 */


    public function users(){
        return $this->hasMany('App\User');
    }

    // 01.user -> +.etab

    public function etablissements(){
        return $this->hasMany('App\Etablissement');
    }


//    public static function etablissements( $iduniv)
//    {
//        $sql = \DB::select("
//			SELECT etablissements.* ,universites.*
//			FROM etablissements LEFT JOIN universites ON universites.iduniv = etablissements.iduniv
//			WHERE iduniv ='".$iduniv."'
//			");
//        return $sql;
//    }

}
