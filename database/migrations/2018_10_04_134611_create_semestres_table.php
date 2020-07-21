<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('cycle_id')->unsigned();
            $table->integer('suffixe')->unsigned();
            $table->dateTime('dateDebutPrevue')->nullable();
            $table->dateTime('dateDebutEff')->nullable();
            $table->dateTime('dateFinPrevue')->nullable();
            $table->dateTime('dateFinEff')->nullable();
            $table->integer('mhSemaine')->unsigned();
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
        Schema::dropIfExists('semestres');
    }
}
