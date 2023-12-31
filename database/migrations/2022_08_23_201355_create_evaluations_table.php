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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('note_max');
            $table->foreignId('type_evaluation_id')->nullable()->constrained();
            $table->foreignId('cours_id')->nullable()->constrained();
            $table->foreignId('classe_id')->nullable()->constrained();
            $table->foreignId('periode_id')->nullable()->constrained();
            $table->date('date_evaluation');
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
        Schema::dropIfExists('evaluations');
    }
};
