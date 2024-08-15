<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KepmenImport;
use Illuminate\Support\Facades\Log;
use App\Models\Kepmen;
use Illuminate\Http\Request;

class KepmenController extends Controller
{
     // Import Kepmen
     public function importKepmen(Request $request)
     {
         // Validasi input
         $request->validate([
             'file' => 'required|mimes:xlsx,xls,csv|max:2048',
             'year' => 'required|integer',
         ]);
 
         $year = $request->input('year'); // Ambil data tahun dari form
 
         try {
             // Import file menggunakan Laravel Excel, dan berikan tahun ke model atau importer jika diperlukan
             Excel::import(new KepmenImport($year), $request->file('file'));
 
             return redirect()->back()->with('success', 'File successfully imported.');
         } catch (\Exception $e) {
             // Log error jika terjadi masalah
             Log::error('Import Error:', ['error' => $e->getMessage()]);
             return redirect()->back()->with('error', 'Failed to import file.');
         }
     }
    
    //delete kepmen
    public function delete(Request $request)
    {
        $year = $request->input('year');

        // Hapus data Kepmen berdasarkan tahun
        Kepmen::where('tahun', $year)->delete();

        return redirect()->route('admin.kepmen')->with('success', 'Data Kepmen tahun ' . $year . ' berhasil dihapus.');
    }

    // Menampilkan Kepmen
    public function showKepmen()
    {
        $kepmen = Kepmen::all();
        return view('admin.kepmen', compact('kepmen'));
    }

    // Activate or Deactivate Kepmen
    public function activateKepmen(Request $request)
    {
        $tahun = $request->input('year');
        $action = $request->input('action');

        if ($action == 'activate') {
            Kepmen::where('tahun', $tahun)->update(['status' => 'aktif']);
            $message = 'Semua Kepmen tahun ' . $tahun . ' berhasil diaktifkan!';
        } elseif ($action == 'deactivate') {
            Kepmen::where('tahun', $tahun)->update(['status' => 'nonaktif']);
            $message = 'Semua Kepmen tahun ' . $tahun . ' berhasil dinonaktifkan!';
        } else {
            return redirect()->route('admin.kepmen')->with('error', 'Aksi tidak valid.');
        }

        return redirect()->route('admin.kepmen')->with('success', $message);
    }

    //search kepmen
    public function index(Request $request)
    {
        $query = $request->input('search');
        $kepmen = Kepmen::query()
            ->where('tahun', 'like', "%{$query}%")
            ->orWhere('status', 'like', "%{$query}%")
            ->orWhere('U', 'like', "%{$query}%")
            ->orWhere('BU', 'like', "%{$query}%")
            ->orWhere('P', 'like', "%{$query}%")
            ->orWhere('K', 'like', "%{$query}%")
            ->orWhere('SK', 'like', "%{$query}%")
            ->orWhere('nomenklatur_urusan_kabupaten_kota', 'like', "%{$query}%")
            ->orWhere('kinerja', 'like', "%{$query}%")
            ->orWhere('indikator', 'like', "%{$query}%")
            ->get();

        return view('admin.kepmen', compact('kepmen'));
    }


}
