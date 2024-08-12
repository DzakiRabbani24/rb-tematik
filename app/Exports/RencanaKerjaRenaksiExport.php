<?php

namespace App\Exports;

use App\Models\KertasKerjaRenaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RencanaKerjaRenaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        // Mengecualikan kolom `id`, `created_at`, dan `updated_at`
        return KertasKerjaRenaksi::select([
            'Tema',
            'Sasaran',
            'Indikator_roadmap',
            'Target',
            'Satuan_Target',
            'Realisasi',
            'Capaian',
            'Catatan',
            'Permasalahan',
            'Sasaran_Permasalahan',
            'Indikator_Permasalahan',
            'Target_indikator_permasalahan',
            'Satuan_target_indikator_permasalahan',
            'Realisasi_Indikator_Permasalahan',
            'Capaian_Indikator_Permasalahan',
            'Catatan_Indikator_Permasalahan',
            'Rencana_Aksi',
            'Indikator_Output',
            'Satuan_Output',
            'Target_TW1',
            'Target_TW2',
            'Target_TW3',
            'Target_TW4',
            'Target_Total',
            'Anggaran',
            'Fokus_Intervensi',
            'Koordinator',
            'Pelaksana',
            'Realisasi_TW1',
            'Realisasi_TW2',
            'Realisasi_TW3',
            'Realisasi_TW4',
            'Realisasi_Total',
            'Realisasi_Anggaran',
            'Catatan_Monev',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Tema',
            'Sasaran',
            'Indikator_roadmap',
            'Target',
            'Satuan Target', // Heading ini bisa disesuaikan dengan tampilan yang Anda inginkan di Excel
            'Realisasi',
            'Capaian',
            'Catatan',
            'Permasalahan',
            'Sasaran Permasalahan',
            'Indikator Permasalahan',
            'Target indikator permasalahan',
            'Satuan target indikator permasalahan',
            'Realisasi Indikator Permasalahan',
            'Capaian Indikator Permasalahan',
            'Catatan Indikator Permasalahan',
            'Rencana Aksi',
            'Indikator Output',
            'Satuan Output',
            'Target TW1',
            'Target TW2',
            'Target TW3',
            'Target TW4',
            'Target Total',
            'Anggaran',
            'Fokus Intervensi',
            'Koordinator',
            'Pelaksana',
            'Realisasi TW1',
            'Realisasi TW2',
            'Realisasi TW3',
            'Realisasi TW4',
            'Realisasi Total',
            'Realisasi Anggaran',
            'Catatan Monev',
        ];
    }

    public function map($row): array
    {
        // Mapping data sesuai dengan urutan kolom
        return [
            $row->Tema,
            $row->Sasaran,
            $row->Indikator_roadmap,
            $row->Target,
            $row->Satuan_Target,
            $row->Realisasi,
            $row->Capaian,
            $row->Catatan,
            $row->Permasalahan,
            $row->Sasaran_Permasalahan,
            $row->Indikator_Permasalahan,
            $row->Target_indikator_permasalahan,
            $row->Satuan_target_indikator_permasalahan,
            $row->Realisasi_Indikator_Permasalahan,
            $row->Capaian_Indikator_Permasalahan,
            $row->Catatan_Indikator_Permasalahan,
            $row->Rencana_Aksi,
            $row->Indikator_Output,
            $row->Satuan_Output,
            $row->Target_TW1,
            $row->Target_TW2,
            $row->Target_TW3,
            $row->Target_TW4,
            $row->Target_Total,
            $row->Anggaran,
            $row->Fokus_Intervensi,
            $row->Koordinator,
            $row->Pelaksana,
            $row->Realisasi_TW1,
            $row->Realisasi_TW2,
            $row->Realisasi_TW3,
            $row->Realisasi_TW4,
            $row->Realisasi_Total,
            $row->Realisasi_Anggaran,
            $row->Catatan_Monev,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Membuat judul kolom (baris pertama) menjadi bold
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
