<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContratEnseignantsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrat_enseignants', function (Blueprint $table) {
            $table->integer('rang')->nullable();
        });

        Schema::table('enseignants', function (Blueprint $table) {
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('domicile')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('profession')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enseignants', function (Blueprint $table) {
            $table->dropColumn('date_naissance')->nullable();
            $table->dropColumn('lieu_naissance')->nullable();
            $table->dropColumn('domicile')->nullable();
            $table->dropColumn('nationalite')->nullable();
            $table->dropColumn('profession')->nullable();
        });

        Schema::table('contrat_enseignants', function (Blueprint $table) {
            $table->dropColumn('rang')->nullable();
        });
    }
}
