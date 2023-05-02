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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->float('periode1')->default(0);
            $table->float('periode2')->default(0);
            $table->float('periode3')->default(0);
            $table->float('periode4')->default(0);
            $table->float('periode5')->default(0);
            $table->float('periode6')->default(0);
            $table->float('examen1')->default(0);
            $table->float('examen2')->default(0);
            $table->float('examen3')->default(0);
            $table->foreignId('frequentation_id')->nullable()->constrained();
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
        Schema::dropIfExists('resultats');
    }
};
