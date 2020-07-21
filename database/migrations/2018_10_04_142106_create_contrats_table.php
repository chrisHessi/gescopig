<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apprenant_id')->unsigned();
            $table->integer('specialite_id')->unsigned();
            $table->integer('cycle_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->string('type');
            $table->string('state')->nullable();
            $table->foreign('apprenant_id')->references('id')->on('apprenants');
            $table->foreign('specialite_id')->references('id')->on('specialites');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            $table->foreign('cycle_id')->references('id')->on('cycles');
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
        Schema::dropIfExists('contrats');
    }
}
