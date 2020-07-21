<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('tel');
            $table->string('matricule')->unique();
            $table->dateTime('dateNaissance');
            $table->string('lieuNaissance');
            $table->string('nationalite');
            $table->string('civilite');
            $table->string('email');
            $table->string('quartier');
            $table->integer('tutor_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->timestamps();
            $table->foreign('tutor_id')->references('id')->on('tutors')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('apprenants');
    }
}
