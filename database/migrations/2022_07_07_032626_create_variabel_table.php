<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variabel', function (Blueprint $table) {
            $table->id();
            $table->integer('indikator_mutu_id');
            $table->enum('jenis', ['lokal', 'nasional'])->default('nasional');
            $table->enum('tipe_variabel', ['numerator', 'denumerator']);
            $table->string('indikator');
            $table->string('satuan');
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
        Schema::dropIfExists('variabel');
    }
}
