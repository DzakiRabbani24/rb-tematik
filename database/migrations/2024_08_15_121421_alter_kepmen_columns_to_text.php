<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKepmenColumnsToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            $table->text('nomenklatur_urusan_kabupaten_kota')->change();
            $table->text('kinerja')->change();
            $table->text('indikator')->change();
            $table->text('satuan')->change();
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
            $table->string('nomenklatur_urusan_kabupaten_kota', 255)->change();
            $table->string('kinerja', 255)->change();
            $table->string('indikator', 255)->change();
            $table->string('satuan', 255)->change();
        });
    }
}