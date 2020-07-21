<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('dateDebutPrevue');
            $table->dateTime('dateDebut')->nullable();
            $table->dateTime('dateFinPrevue');
            $table->dateTime('dateFin')->nullable();
            $table->integer('semestre_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->foreign('semestre_id')->references('id')->on('semestres');
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
        Schema::dropIfExists('academic_calendars');
    }
}
