<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestre_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semestre_id')->unsigned();
            $table->integer('contrat_id')->unsigned();
            $table->integer('nbUeValid')->unsigned()->nullable();
            $table->integer('creditObt')->unsigned()->nullable();
            $table->float('moyenne')->unsigned();
            $table->string('session')->nullable();
            $table->string('mention')->nullable();
            $table->foreign('semestre_id')->references('id')->on('semestres');
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
        Schema::dropIfExists('semestre_infos');
    }
}
