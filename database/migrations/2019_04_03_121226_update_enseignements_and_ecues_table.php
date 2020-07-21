<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEnseignementsAndEcuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecues', function(Blueprint $table){
//            $table->dropForeign('ecues_ue_id_foreign');
            $table->dropColumn('ue_id');
            $table->dropColumn('credits');
        });

        Schema::table('enseignements', function(Blueprint $table){
            $table->integer('ue_id')->unsigned()->after('academic_year_id');
            $table->integer('credits')->unsigned()->after('ue_id');
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
