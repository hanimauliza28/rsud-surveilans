<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilSurveyImutNasionalDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_survey_imut_nasional_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hasil_survey_id');
            $table->bigInteger('variabel_survey_id');
            $table->string('sub_variabel');
            $table->string('value');
            $table->integer('point');
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
        Schema::dropIfExists('hasil_survey_imut_nasional_detail');
    }
}
