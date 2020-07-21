<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApprenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::table('apprenants', function (Blueprint $table) {
            $table->dropForeign('apprenants_tutor_id_foreign');
            $table->dropColumn('tutor_id');
            $table->string('academic_mail')->nullable();
            $table->string('diplome')->nullable();
            $table->string('addresse')->nullable();
            $table->string('situation_professionnelle')->nullable();

        });
        Schema::table('tutors', function (Blueprint $table) {
            $table->foreign('apprenant_id')->references('id')->on('apprenants');
        });
        Schema::enableForeignKeyConstraints();
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
