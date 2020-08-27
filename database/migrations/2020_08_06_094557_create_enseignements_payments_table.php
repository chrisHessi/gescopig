<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignementsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignements_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enseignement_id')->unsigned();
            $table->integer('teacher_pays_id')->unsigned();
            $table->foreign('enseignement_id')->references('id')->on('enseignements')->onDelete('restrict');
            $table->foreign('teacher_pays_id')->references('id')->on('teacher_pays')
                ->onDelete('restrict');
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
        Schema::dropIfExists('enseignements_payments');
    }
}
