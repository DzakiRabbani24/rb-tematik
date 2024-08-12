<?php

namespace App\Imports;

use App\Models\KertasKerjaRenaksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KertasKerjaRenaksiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Periksa jika baris memiliki data di kolom yang diperlukan
        if (empty($row['tema']) && empty($row['sasaran']) && empty($row['indikator_roadmap'])) {
            // Jika semua kolom yang diperlukan kosong, abaikan baris ini
            return null;
        }

        return new KertasKerjaRenaksi([
            'tema' => $row['tema'] ?? null,
            'sasaran' => $row['sasaran'] ?? null,
            'indikator_roadmap' => $row['indikator_roadmap'] ?? null,
            'target' => $row['target'] ?? null,
            'satuan_target' => $row['satuan_target'] ?? null,
            'realisasi' => $row['realisasi'] ?? null,
            'capaian' => $row['capaian'] ?? null,
            'catatan' => $row['catatan'] ?? null,
            'permasalahan' => $row['permasalahan'] ?? null,
            'sasaran_permasalahan' => $row['sasaran_permasalahan'] ?? null,
            'indikator_permasalahan' => $row['indikator_permasalahan'] ?? null,
            'target_indikator_permasalahan' => $row['target_indikator_permasalahan'] ?? null,
            'satuan_target_indikator_permasalahan' => $row['satuan_target_indikator_permasalahan'] ?? null,
            'realisasi_indikator_permasalahan' => $row['realisasi_indikator_permasalahan'] ?? null,
            'capaian_indikator_permasalahan' => $row['capaian_indikator_permasalahan'] ?? null,
            'catatan_indikator_permasalahan' => $row['catatan_indikator_permasalahan'] ?? null,
            'rencana_aksi' => $row['rencana_aksi'] ?? null,
            'indikator_output' => $row['indikator_output'] ?? null,
            'satuan_output' => $row['satuan_output'] ?? null,
            'target_tw1' => $row['target_tw1'] ?? null,
            'target_tw2' => $row['target_tw2'] ?? null,
            'target_tw3' => $row['target_tw3'] ?? null,
            'target_tw4' => $row['target_tw4'] ?? null,
            'target_total' => $row['target_total'] ?? null,
            'anggaran' => $row['anggaran'] ?? null,
            'fokus_intervensi' => $row['fokus_intervensi'] ?? null,
            'koordinator' => $row['koordinator'] ?? null,
            'pelaksana' => $row['pelaksana'] ?? null,
            'realisasi_tw1' => $row['realisasi_tw1'] ?? null,
            'realisasi_tw2' => $row['realisasi_tw2'] ?? null,
            'realisasi_tw3' => $row['realisasi_tw3'] ?? null,
            'realisasi_tw4' => $row['realisasi_tw4'] ?? null,
            'realisasi_total' => $row['realisasi_total'] ?? null,
            'realisasi_anggaran' => $row['realisasi_anggaran'] ?? null,
            'catatan_monev' => $row['catatan_monev'] ?? null,
        ]);
    }
}