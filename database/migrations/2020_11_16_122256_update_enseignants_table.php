<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enseignants', function (Blueprint $table) {
            $table->string('titre')->nullable()->after('id');
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
            $table->dropColumn('titre');
            $table->dropColumn('date_naissance')->nullable();
            $table->dropColumn('lieu_naissance')->nullable();
            $table->dropColumn('domicile')->nullable();
            $table->dropColumn('nationalite')->nullable();
            $table->dropColumn('profession')->nullable();
        });
    }
}
