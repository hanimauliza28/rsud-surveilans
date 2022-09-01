<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilSurveyImutNasionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_survey_imut_nasional', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_object');
            $table->string('jenis_object');
            $table->date('tgl_survey');
            $table->integer('indikator_mutu_id');
            $table->string('surveyor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('hasil_survey_imut_nasional');
    }
}
