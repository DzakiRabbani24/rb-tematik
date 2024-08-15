<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixKepmenTableAddKinerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            $table->string('kinerja')->nullable()->after('nomenklatur_urusan_kabupaten_kota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            $table->dropColumn('kinerja');
        });
    }
}
