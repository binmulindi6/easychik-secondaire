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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->integer("max_periode");
            $table->integer("max_examen");
            // $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('categorie_cours_id')->nullable()->constrained();
            $table->foreignId('niveau_id')->nullable()->constrained();
            $table->foreignId('section_id')->nullable()->constrained();
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
        Schema::dropIfExists('cours');
    }
};
