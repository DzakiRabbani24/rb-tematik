<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKertasKerjaRenaksiTable extends Migration
{
    public function up()
    {
        Schema::create('kertas_kerja_renaksi', function (Blueprint $table) {
            $table->id();
            $table->string('Tema')->nullable();
            $table->string('Sasaran')->nullable();
            $table->string('Indikator Roadmap')->nullable();
            $table->string('Target')->nullable();
            $table->string('Satuan Target')->nullable();
            $table->string('Realisasi')->nullable();
            $table->string('Capaian')->nullable();
            $table->text('Catatan')->nullable();
            $table->string('Permasalahan')->nullable();
            $table->string('Sasaran Permasalahan')->nullable();
            $table->string('Indikator Permasalahan')->nullable();
            $table->string('Target Indikator Permasalahan')->nullable();
            $table->string('Satuan Target Indikator Permasalahan')->nullable();
            $table->string('Realisasi Indikator Permasalahan')->nullable();
            $table->string('Capaian Indikator Permasalahan')->nullable();
            $table->text('Catatan Indikator Permasalahan')->nullable();
            $table->text('Rencana Aksi')->nullable();
            $table->string('Indikator Output')->nullable();
            $table->string('Satuan Output')->nullable();
            $table->string('Target TW1')->nullable();
            $table->string('Target TW2')->nullable();
            $table->string('Target TW3')->nullable();
            $table->string('Target TW4')->nullable();
            $table->string('Target Total')->nullable();
            $table->decimal('Anggaran', 15, 2)->nullable();
            $table->string('Fokus Intervensi')->nullable();
            $table->string('Koordinator')->nullable();
            $table->string('Pelaksana')->nullable();
            $table->string('Realisasi TW1')->nullable();
            $table->string('Realisasi TW2')->nullable();
            $table->string('Realisasi TW3')->nullable();
            $table->string('Realisasi TW4')->nullable();
            $table->string('Realisasi Total')->nullable();
            $table->decimal('Realisasi Anggaran', 15, 2)->nullable();
            $table->text('Catatan Monev')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kertas_kerja_renaksi');
    }
}