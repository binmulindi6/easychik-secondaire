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
            $table->string("matricule");
            $table->string("id_nationale");
            $table->string("nom");
            $table->string("prenom");
            $table->string('sexe');
            $table->string("lieu_naissance");
            $table->date("date_naissance");
            $table->string("nom_pere");
            $table->string("nom_mere");
            $table->string("adresse");
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
        Schema::dropIfExists('eleves');
    }
};
