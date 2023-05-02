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
        Schema::create('eleve_conduites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->nullable()->constrained();
            $table->foreignId('conduite_id')->nullable()->constrained();
            $table->foreignId('periode_id')->nullable()->constrained();
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
        Schema::dropIfExists('table_eleve_conduite');
    }
};
