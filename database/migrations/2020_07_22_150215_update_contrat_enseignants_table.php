<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContratEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrat_enseignants', function (Blueprint $table) {
            $table->integer('mh_licence')->unsigned()->nullable();
            $table->integer('mh_master')->unsigned()->nullable();
            $table->integer('rang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contrat_enseignants', function (Blueprint $table) {
            $table->dropColumn('rang')->nullable();
            $table->dropColumn('mh_licence')->nullable();
            $table->dropColumn('mh_master')->nullable();
        });
    }
}
