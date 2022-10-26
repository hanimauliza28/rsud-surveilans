<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnthropometricResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anthropometric_result', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_survey');
            $table->string('norm', 5);
            $table->string('noreg')->nullable();
            $table->integer('umur');
            $table->decimal('bb', 4, 2);
            $table->decimal('tb', 5, 2);
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
        Schema::dropIfExists('anthropometric_result');
    }
}
