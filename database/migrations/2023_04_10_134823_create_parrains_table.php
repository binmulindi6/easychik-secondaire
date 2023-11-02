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
        Schema::create('parrains', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->unique()->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe')->default('M');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->string("nationalite")->nullable();
            $table->string('isBiologique')->nullable();
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
        Schema::dropIfExists('parent');
    }
};
