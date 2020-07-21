<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcheanciersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echeanciers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cycle_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('montant')->unsigned();
            $table->string('tranche');
            $table->dateTime('date');
            $table->foreign('cycle_id')->references('id')->on('cycles');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
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
        Schema::dropIfExists('echeanciers');
    }
}
