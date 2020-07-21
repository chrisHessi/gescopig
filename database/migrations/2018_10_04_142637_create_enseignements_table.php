<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enseignant_id')->unsigned();
            $table->integer('ecue_id')->unsigned();
            $table->integer('specialite_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->integer('mhTotal')->unsigned();
            $table->integer('mhEff')->unsigned()->nullable();
            $table->foreign('academic_year_id')->references('id')->on('academic_years')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('enseignant_id')->references('id')->on('enseignants');
            $table->foreign('ecue_id')->references('id')->on('ecues');
            $table->foreign('specialite_id')->references('id')->on('specialites');
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
        Schema::dropIfExists('enseignements');
    }
}
