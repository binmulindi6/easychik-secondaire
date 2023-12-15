<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string("matricule")->nullable();
            $table->string('avatar')->unique()->nullable();
            $table->string("num_permanent")->nullable();
            $table->string("nom")->nullable();
            $table->string("prenom")->nullable();
            $table->string('sexe')->nullable();
            $table->string("lieu_naissance")->nullable();
            $table->date("date_naissance")->nullable();
            $table->string("nationalite")->default('Congolaise');
            $table->string("nom_pere")->nullable();
            $table->string("nom_mere")->nullable();
            $table->string("profession_pere")->nullable();
            $table->string("profession_mere")->nullable();
            $table->string("email")->nullable();
            $table->string("telephone_pere")->nullable();
            $table->string("telephone_mere")->nullable();
            $table->string("medecin_traitant")->nullable();
            $table->string("allergie_alimentaire")->nullable();
            $table->string("probleme_sante")->nullable();
            $table->string("langue_maternelle")->nullable();
            $table->string("familiers_inscrits_ici")->nullable();
            $table->string("personne_autorise")->nullable();
            $table->string("adresse")->nullable();
            $table->boolean('isActive')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleves');
    }
};
