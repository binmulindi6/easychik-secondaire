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
        Schema::create('paiement_frais', function (Blueprint $table) {
            $table->id();
            $table->integer('montant_paye');
            $table->string('reference')->nullable();
            $table->foreignId('frais_id')->nullable()->constrained();
            $table->foreignId('eleve_id')->nullable()->constrained();
            $table->foreignId('moyen_paiement_id')->nullable()->constrained();
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
        Schema::dropIfExists('paiement_frais');
    }
};
