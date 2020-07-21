<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrat_id')->unsigned();
            $table->integer('enseignement_id')->unsigned();
            $table->foreign('enseignement_id')->references('id')->on('enseignements');
            $table->foreign('contrat_id')->references('id')->on('contrats');
            $table->timestamps();
        });

        Schema::table('semestres', function (Blueprint $table) {
            $table->dropColumn('dateDebutPrevue');
            $table->dropColumn('dateDebutEff');
            $table->dropColumn('dateFinPrevue');
            $table->dropColumn('dateFinEff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('second_sessions');
    }
}
