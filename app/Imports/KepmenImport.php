<?php

namespace App\Imports;

use App\Models\Kepmen;
use App\Models\KepmenDb;
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

    protected $year;

    public function __construct($year)
    {
        $this->year = $year;

        KepmenDb::firstOrCreate(
            ['tahun' => $this->year],
            ['status' => 'nonaktif']
        );
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Log all headers for debugging
            // Log::info('Headers:', array_keys($row->toArray()));
            // Log row data for debugging
            // Log::info('Importing row:', $row->toArray());
            $status = KepmenDb::where('tahun', $this->year)->value('status');
            
            // Cek dan trim nilai SK

            // Create and save a new Kepmen model


            Kepmen::create([
                'tahun' => $this->year, // Gunakan tahun yang dipilih
                'u' => $row['u'],
                'bu' => $row['bu'],
                'p' => $row['p'],
                'k' => $row['k'],
                'sk' => $row['sk'],
                'nomenklatur_urusan_kabupaten_kota' => $row['nomenklatur_urusan_kabupaten_kota'],
                'kinerja' => $row['kinerja'],
                'indikator' => $row['indikator'],
                'satuan' => $row['satuan'],
                'status' => $status // Set status dari tabel kepmen_db
            ]);
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}
