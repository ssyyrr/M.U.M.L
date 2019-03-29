<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cin')->unique();
            $table->string('name');
            $table->string('prenom');
            $table->string('datenaissance');
            $table->string('email');
            $table->string('password');
            $table->string('universite_id');
            $table->string('etablissement_id');
            $table->string('profile')->default('Etudiant');
            $table->string('grade')->default('Etudiant');
            $table->mediumText('addresse')->nullable();
            $table->string('numtel');

            $table->string('type')->default('Etudiant');
            $table->mediumText('bio')->nullable();
            $table->string('photo')->default('logo.jpg');
            $table->rememberToken();
            $table->timestamps();

//            $table->foreign('universite_id')->references('id')->on('universites');
//            $table->foreign('etablissement_id')->references('id')->on('etablissements');

        });

        DB::table('users')->insert([
            'cin' => '0101011001',
            'name' => 'administrator',
            'prenom' => 'administrator',
            'datenaissance' => '01/01/2019',
            'email' => 'administrator@example.com',
            'password' => Hash::make('123456'),
            'universite_id' => '30',
            'etablissement_id' => '222',
            'profile' => 'Enseignant',
            'grade' => 'Maitre de conference',
            'addresse' => 'tunisie',
            'numtel' => '123456',
            'type' => 'Superadministrator',
            'bio' => 'Super admin systeme par defaut',
            'photo' => 'logo.jpg',
            ]
        );



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
// INSERT INTO `users` VALUES (1,'00000000','admin','admin','01/01/1990','admin@me.com','123456','30','222','Enseignant',
//'Professeur','address','0212525545','admin','bio','profile.png'),
