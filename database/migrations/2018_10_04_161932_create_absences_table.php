<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->boolean('justify');
            $table->text('justification')->nullable();
            $table->integer('ecue_id')->unsigned();
            $table->integer('contrat_id')->unsigned();
            $table->foreign('contrat_id')->references('id')->on('contrats');
            $table->foreign('ecue_id')->references('id')->on('ecues');
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
        Schema::dropIfExists('absences');
    }
}
