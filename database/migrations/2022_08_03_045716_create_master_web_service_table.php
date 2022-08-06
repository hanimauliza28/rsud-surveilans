<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterWebServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_web_service', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_unik');
            $table->string('url');
            $table->string('type');
            $table->enum('jenis_service', ['dataPasien', 'dataPelayanan']);
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
        Schema::dropIfExists('master_web_service');
    }
}
