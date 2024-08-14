<?php

namespace App\Imports;

use App\Models\Kepmen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class KepmenImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        // Pastikan kolom yang diperlukan tidak kosong
        if (isset($row['U']) && isset($row['BU']) && isset($row['P']) && isset($row['K'])) {
            return new Kepmen([
                'U' => $row['U'],
                'BU' => $row['BU'],
                'P' => $row['P'],
                'K' => $row['K'],
                'SK' => isset($row['SK']) ? $row['SK'] : null,
                'nomenklatur_urusan_kabupaten_kota' => $row['nomenklatur_urusan_kabupaten_kota'],
                'indikator' => $row['indikator'],
                'status' => 'nonaktif',
                'tahun' => isset($row['tahun']) ? $row['tahun'] : null,
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Sesuaikan ukuran chunk sesuai kebutuhan
    }
}