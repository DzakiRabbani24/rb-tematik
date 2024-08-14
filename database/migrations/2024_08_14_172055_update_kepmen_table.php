<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKepmenTable extends Migration
{
    public function up()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            // Ubah kolom menjadi text
            $table->text('U')->change();
            $table->text('BU')->change();
            $table->text('P')->change();
            $table->text('K')->change();
            $table->text('SK')->change();
            $table->text('nomenklatur_urusan_kabupaten_kota')->change();
            $table->text('indikator')->change();
            // Status kolom
            $table->string('status')->default('nonaktif')->change();
            // Tahun kolom, bisa null
            $table->integer('tahun')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            // Kembalikan perubahan jika diperlukan
            $table->string('U')->change();
            $table->string('BU')->change();
            $table->string('P')->change();
            $table->string('K')->change();
            $table->string('SK')->change();
            $table->string('nomenklatur_urusan_kabupaten_kota')->change();
            $table->string('indikator')->change();
            $table->string('status')->default('nonaktif')->change();
            $table->integer('tahun')->change();
        });
    }
}