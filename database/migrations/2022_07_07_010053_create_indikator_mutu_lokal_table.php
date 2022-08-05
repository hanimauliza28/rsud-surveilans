<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorMutuLokalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_mutu_lokal', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_indikator_id');
            $table->string('judul');
            $table->text('definisi_operasional');
            $table->text('kriteria_inklusi');
            $table->text('kriteria_eksklusi');
            $table->string('sumber_data');
            $table->string('area_monitoring');
            $table->string('standar');
            $table->string('faktor_pengali');
            $table->string('satuan');
            $table->integer('tipe_indikator_id');
            $table->integer('frekuensi_id');
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
        Schema::dropIfExists('indikator_mutu_lokal');
    }
}
