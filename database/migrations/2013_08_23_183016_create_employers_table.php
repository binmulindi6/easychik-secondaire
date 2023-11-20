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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('avatar')->unique()->nullable();
            $table->string("nom");
            $table->string("prenom");
            $table->string("sexe");
            $table->date("date_naissance");
            $table->string("etat_civil")->nullable();
            $table->string("nationalite")->default('CONGOLAISE');
            $table->string("formation");
            $table->string("diplome");
            $table->string("telephone1")->nullable();
            $table->string("telephone2")->nullable();
            $table->string("diplome");
            $table->string("niveau_etude")->nullable();
            $table->boolean("isActive")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
};
