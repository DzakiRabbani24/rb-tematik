<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKertasKerjaRenaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kertas_kerja_renaksi', function (Blueprint $table) {
            $table->id();
            $table->string('tema')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('indikator_roadmap')->nullable();
            $table->string('target')->nullable();
            $table->string('satuan_target')->nullable();
            $table->string('realisasi')->nullable();
            $table->string('capaian')->nullable();
            $table->text('catatan')->nullable();
            $table->string('permasalahan')->nullable();
            $table->string('sasaran_permasalahan')->nullable();
            $table->string('indikator_permasalahan')->nullable();
            $table->string('target_indikator_permasalahan')->nullable();
            $table->string('satuan_target_indikator_permasalahan')->nullable();
            $table->string('realisasi_indikator_permasalahan')->nullable();
            $table->string('capaian_indikator_permasalahan')->nullable();
            $table->text('catatan_indikator_permasalahan')->nullable();
            $table->text('rencana_aksi')->nullable();
            $table->string('indikator_output')->nullable();
            $table->string('satuan_output')->nullable();
            $table->string('target_tw1')->nullable();
            $table->string('target_tw2')->nullable();
            $table->string('target_tw3')->nullable();
            $table->string('target_tw4')->nullable();
            $table->string('target_total')->nullable();
            $table->string('anggaran')->nullable();
            $table->string('fokus_intervensi')->nullable();
            $table->string('koordinator')->nullable();
            $table->string('pelaksana')->nullable();
            $table->string('realisasi_tw1')->nullable();
            $table->string('realisasi_tw2')->nullable();
            $table->string('realisasi_tw3')->nullable();
            $table->string('realisasi_tw4')->nullable();
            $table->string('realisasi_total')->nullable();
            $table->string('realisasi_anggaran')->nullable();
            $table->text('catatan_monev')->nullable();
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
        Schema::dropIfExists('kertas_kerja_renaksi');
    }
}