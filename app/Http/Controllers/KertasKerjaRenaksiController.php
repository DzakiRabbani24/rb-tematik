<?php

namespace App\Http\Controllers;

use App\Imports\KertasKerjaRenaksiImport;
use App\Exports\RencanaKerjaRenaksiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KertasKerjaRenaksiController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new KertasKerjaRenaksiImport, $request->file('file'));

        session()->flash('success', 'File berhasil di-upload!');
    
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new RencanaKerjaRenaksiExport, 'kertas_kerja_renaksi.xlsx');
    }
}