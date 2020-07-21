<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('semestre_id')->unsigned();
            $table->string('slug');
            $table->foreign('semestre_id')->references('id')->on('semestres');
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
        Schema::dropIfExists('ecues');
    }
}
