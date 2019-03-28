<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intitule')->default('Universite Virtuelle de Tunis');
            $table->string('abrev')->default('UVT');;

        });

                                DB::table('universites')->insert (
                                    [ 'id' =>'01'   ,'intitule' =>'UniversitÃ© Exmple'  , 'abrev' => 'UnivExmpl']

                                );

   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universites');
    }
}

//
////-- Table structure for table `universite`
// INSERT INTO `universites` VALUES (30,'UniversitÃ© Viruelle De Tunis','uvt'),
//(31,'UniversitÃ© Tunis El Manar','utm'),
//(34,'UniversitÃ© Ez-Zitouna','uz'),
//(35,'UniversitÃ©  Carthage','u7nc'),
//(36,'UniversitÃ© de Sousse','us'),
//(37,'UniversitÃ© de Sfax','usf'),
//(38,'UniversitÃ© de Tunis','ut'),
//(39,'UniversitÃ© de la Manouba','uma'),
//(40,'UniversitÃ© de Monastir','um'),
//(41,'UniversitÃ© de Gafsa','ugf'),
//(42,'Instituts SupÃ©rieurs des Etudes Technologiques','iset'),
//(43,'UniversitÃ© de Jendouba','uj'),
//(44,'UniversitÃ© de Kairouan','uk'),
//(45,'UniversitÃ© de GabÃ¨s','ugb'),
//(46,'Universites partenaires','upa');
//
