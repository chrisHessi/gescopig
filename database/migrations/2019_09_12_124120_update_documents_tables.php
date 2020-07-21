<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDocumentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attestations', function (Blueprint $table) {
            $table->integer('rang')->unsigned();
        });

        Schema::table('autorisations', function (Blueprint $table) {
            $table->integer('rang')->unsigned();
        });

        Schema::table('inscriptions', function (Blueprint $table) {
            $table->integer('rang')->unsigned();
        });

        Schema::table('preinscriptions', function (Blueprint $table) {
            $table->integer('rang')->unsigned();
        });

        Schema::table('certificats', function (Blueprint $table) {
            $table->integer('rang')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
