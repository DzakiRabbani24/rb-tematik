<?php

namespace App\Imports;

use App\Models\Kepmen;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class KepmenImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    use Importable, SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Log all headers for debugging
            // Log::info('Headers:', array_keys($row->toArray()));
            // Log row data for debugging
            // Log::info('Importing row:', $row->toArray());
            
            // Cek dan trim nilai SK
            $sk = trim($row['sk']);
            if (empty($sk)) {
                // Log::error('Skipping row due to empty SK field: ' . $sk);
                continue; // Skip this row
            }

            // Create and save a new Kepmen model
            Kepmen::create([
                'u' => $row['u'],
                'bu' => $row['bu'],
                'p' => $row['p'],
                'k' => $row['k'],
                'sk' => $row['sk'],
                'nomenklatur_urusan_kabupaten_kota' => $row['nomenklatur_urusan_kabupaten_kota'],
                'kinerja' => $row['kinerja'],
                'indikator' => $row['indikator'],
                'satuan' => $row['satuan']
            ]);
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}
