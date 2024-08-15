<?php

namespace App\Imports;

use App\Models\Kepmen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Log;

class KepmenImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable, SkipsFailures;
    
    
    public function model(array $row)
    {
        // Log all headers for debugging
        Log::info('Headers:', array_keys($row));
        // Log row data for debugging
        Log::info('Importing row:', $row);
        
        // Cek dan trim nilai SK
        $sk = trim($row['sk']);
        if (empty($sk)) {
            Log::error('Skipping row due to empty SK field: ' . $row['sk']);
            return null; // Return null to skip this row
        }

        
        // Proceed with creating and returning a new Kepmen model
        return new Kepmen([
            'u' => $row['u'],
            'bu' => $row['bu'],
            'p' => $row['p'],
            'k' => $row['k'],
            'sk' => $row['sk'],
            'nomenklatur_urusan_kabupaten_kota' => $row['nomenklatur_urusan_kabupaten_kota'] ?? null,
            'kinerja' => $row['kinerja'] ?? null,
            'indikator' => $row['indikator'] ?? null,
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}