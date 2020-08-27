<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrat_enseignant_id')->unsigned();
            $table->integer('montant')->unsigned();
            $table->dateTime('date');
            $table->enum('tranche', ['4/5', '1/5', '100%']);
            $table->string('numero_piece')->nullable();
            $table->text('observation')->nullable();
            $table->foreign('contrat_enseignant_id')->references('id')->on('contrat_enseignants')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_pays');
    }
}
