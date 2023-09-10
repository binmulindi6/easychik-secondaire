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
        Schema::create('entree_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable()->constrained();
            $table->integer('quantite');
            $table->text('designation');
            $table->float('prix');
            $table->string('devise')->default('USD');
            $table->date('date');
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
        Schema::dropIfExists('entree_articles');
    }
};
