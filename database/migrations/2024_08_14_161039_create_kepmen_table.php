<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepmenTable extends Migration
{
    public function up()
    {
        Schema::create('kepmen', function (Blueprint $table) {
            $table->id();
            $table->text('U');
            $table->text('BU');
            $table->text('P');
            $table->text('K');
            $table->text('SK');
            $table->text('nomenklatur_urusan_kabupaten_kota');
            $table->text('indikator');
            $table->string('status')->default('nonaktif');
            $table->integer('tahun')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kepmen');
    }
}