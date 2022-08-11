<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaFunctioToImut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indikator_mutu_nasional', function (Blueprint $table) {
            $table->string('nama_route')->nullable()->after('judul');
        });

        Schema::table('indikator_mutu_lokal', function (Blueprint $table) {
            $table->string('nama_route')->nullable()->after('judul');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indikator_mutu_nasional', function (Blueprint $table) {
            $table->dropColumn('nama_route');
        });

        Schema::table('indikator_mutu_lokal', function (Blueprint $table) {
            $table->dropColumn('nama_route');
        });
    }
}
