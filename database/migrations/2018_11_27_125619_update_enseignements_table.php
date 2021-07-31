<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enseignements', function (Blueprint $table) {
            $table->boolean('communication')->default(false);
            $table->boolean('cc')->default(false);
            $table->boolean('progression')->default(false);
            $table->integer('tronc_commun_id')->unsigned()->nullable();
            $table->foreign('tronc_commun_id')->references('id')->on('tronc_communs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enseignements', function (Blueprint $table) {
            //
        });
    }
}
