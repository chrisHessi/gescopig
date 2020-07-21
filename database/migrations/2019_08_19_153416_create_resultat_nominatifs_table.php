<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultatNominatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultat_nominatifs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrat_id')->unsigned();
            $table->integer('next_cycle_id')->unsigned();
            $table->string('decision');
            $table->foreign('next_cycle_id')->references('id')->on('cycles');
            $table->foreign('contrat_id')->references('id')->on('contrats');
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
        Schema::dropIfExists('resultat_nominatifs');
    }
}
