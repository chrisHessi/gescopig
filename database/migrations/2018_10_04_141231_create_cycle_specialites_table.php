<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCycleSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycle_specialites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cycle_id')->unsigned();
            $table->integer('specialite_id')->unsigned();
            $table->foreign('cycle_id')->references('id')->on('cycles');
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
        Schema::dropIfExists('cycle_specialites');
    }
}
