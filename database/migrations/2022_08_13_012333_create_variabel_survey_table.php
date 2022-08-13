<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariabelSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variabel_survey', function (Blueprint $table) {
            $table->id();
            $table->string('nama_variabel');
            $table->string('nama');
            $table->string('keterangan');
            $table->bigInteger('kategori_variabel_survey_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('variabel_survey');
    }
}
