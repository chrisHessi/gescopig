<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScolaritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->integer('dette')->nullable()->after('academic_year_id');
            $table->boolean('moratoire')->default(false)->after('academic_year_id');
        });

        Schema::table('apprenants', function(Blueprint $table){
            $table->string('region')->nullable()->after('nationalite');
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
