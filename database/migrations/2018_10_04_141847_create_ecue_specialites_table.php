<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcueSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecue_specialites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ecue_id')->unsigned();
            $table->integer('specialite_id')->unsigned();
            $table->foreign('ecue_id')->references('id')->on('ecues')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('specialite_id')->references('id')->on('specialites')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('ecue_specialites');
    }
}
