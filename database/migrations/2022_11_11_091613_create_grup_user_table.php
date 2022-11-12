<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup_user', function (Blueprint $table) {
            $table->id();
            $table->string('nama_grup');
            $table->string('kd_grup_bagian');
            $table->string('grup_bagian');
            $table->string('kd_bagian');
            $table->string('nama_bagian');
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
        Schema::dropIfExists('grup_user');
    }
}
