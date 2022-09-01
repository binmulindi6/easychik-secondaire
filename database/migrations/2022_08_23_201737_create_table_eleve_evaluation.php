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
        Schema::create('table_eleve_evaluation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained();
            $table->foreignId('evaluation_id')->constrained();
            $table->integer('note_obtenu');
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
        Schema::dropIfExists('table_eleve_evaluation');
    }
};
