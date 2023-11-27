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
        Schema::create('ecoles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('abbreviation');
            $table->string('bp')->nullable();
            $table->string('pays');
            $table->string('province');
            $table->string('ville');
            $table->string('commune');
            $table->string('code');
            $table->string('ministere');
            $table->string('reussite');
            $table->string('telephone1')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('email')->nullable();
            $table->string('subscription')->nullable();
            $table->string('domain')->nullable();
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
        Schema::dropIfExists('table_ecole');
    }
};
