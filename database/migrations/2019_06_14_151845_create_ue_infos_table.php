<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ue_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ue_id')->unsigned();
            $table->integer('contrat_id')->unsigned();
            $table->integer('creditTot')->unsigned()->nullable();
            $table->integer('creditObt')->unsigned()->nullable();
            $table->string('mention')->nullable();
            $table->float('moyenne')->unsigned()->nullable();
            $table->foreign('ue_id')->references('id')->on('ues');
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
        Schema::dropIfExists('ue_infos');
    }
}
