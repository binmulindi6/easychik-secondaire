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
        Schema::create('eleve_examen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->nullable()->constrained();
            $table->foreignId('examen_id')->nullable()->constrained();
            $table->integer('note_obtenu')->default(0);
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
        Schema::dropIfExists('eleve_examen');
    }
};
