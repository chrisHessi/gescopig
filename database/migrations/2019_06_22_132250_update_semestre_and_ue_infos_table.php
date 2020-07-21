<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSemestreAndUeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ue_infos', function(Blueprint $table){
            $table->float('totalNotes')->unsigned()->nullable()->after('moyenne');
        });

        Schema::table('semestre_infos', function(Blueprint $table){
            $table->float('totalNotes')->unsigned()->nullable()->after('moyenne');
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
