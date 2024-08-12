<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KertasKerjaRenaksi extends Model
{
    use HasFactory;

    protected $table = 'kertas_kerja_renaksi'; // Ganti dengan nama tabel yang sesuai
    protected $fillable = [
        'tema', 'sasaran', 'indikator_roadmap', 'target', 'satuan_target', 
        'realisasi', 'capaian', 'catatan', 'permasalahan', 'sasaran_permasalahan', 
        'indikator_permasalahan', 'target_indikator_permasalahan', 
        'satuan_target_indikator_permasalahan', 'realisasi_indikator_permasalahan', 
        'capaian_indikator_permasalahan', 'catatan_indikator_permasalahan', 
        'rencana_aksi', 'indikator_output', 'satuan_output', 'target_tw1', 
        'target_tw2', 'target_tw3', 'target_tw4', 'target_total', 'anggaran', 
        'fokus_intervensi', 'koordinator', 'pelaksana', 'realisasi_tw1', 
        'realisasi_tw2', 'realisasi_tw3', 'realisasi_tw4', 'realisasi_total', 
        'realisasi_anggaran', 'catatan_monev'
    ];
}