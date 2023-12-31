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
        Schema::create('employer_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->nullable()->constrained();
            $table->foreignId('annee_scolaire_id')->nullable()->constrained();
            $table->foreignId('type_presence_id')->nullable()->constrained();
            $table->date('date');
            $table->text('motif')->nullable();
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
        Schema::dropIfExists('employer_presences');
    }
};
