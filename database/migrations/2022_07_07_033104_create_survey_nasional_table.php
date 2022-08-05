<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyNasionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_nasional', function (Blueprint $table) {
            $table->id();
            $table->integer('indikator_mutu_id');
            $table->date('tanggal_survey');
            $table->double('numerator');
            $table->double('denumerator');
            $table->double('hasil');
            $table->integer('user_id');
            $table->string('sumber_data');
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
        Schema::dropIfExists('survey_nasional');
    }
}
