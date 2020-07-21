<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrat_id')->unsigned();
            $table->foreign('contrat_id')->references('id')->on('contrats');
            $table->timestamps();
        });

        Schema::table('ecues', function (Blueprint $table) {
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
        });



        Schema::disableForeignKeyConstraints();
        Schema::table('enseignements', function (Blueprint $table) {
            $table->dropForeign('enseignements_enseignant_id_foreign');
            $table->dropColumn('enseignant_id');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_cards');
    }
}
