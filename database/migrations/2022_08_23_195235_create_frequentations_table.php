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
        Schema::create('frequentations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained();
            $table->foreignId('classe_id')->constrained();
            $table->foreignId('annee_scolaire_id')->constrained();

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
        Schema::dropIfExists('frequentations');
    }
};
