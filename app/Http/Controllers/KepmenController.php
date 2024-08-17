<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\KepmenDb;
use App\Models\Kepmen;
use App\Imports\KepmenImport;

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

        // Hapus data KepmenDb berdasarkan tahun
        KepmenDb::where('tahun', $year)->delete();

        return redirect()->route('admin.kepmen')->with('success', 'Data Kepmen  tahun ' . $year . ' berhasil dihapus.');
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
            // Update status di kepmen_db
            KepmenDb::where('tahun', $tahun)->update(['status' => 'aktif']);
        } elseif ($action == 'deactivate') {
            // Update status di kepmen_db
            KepmenDb::where('tahun', $tahun)->update(['status' => 'nonaktif']);
        } else {
            return redirect()->route('admin.kepmen')->with('error', 'Aksi tidak valid.');
        }

        // Update status di kepmen sesuai dengan status di kepmen_db
        $status = KepmenDb::where('tahun', $tahun)->value('status');
        Kepmen::where('tahun', $tahun)->update(['status' => $status]);

        $message = 'Status Kepmen tahun ' . $tahun . ' berhasil diperbarui menjadi ' . $status . '!';

        return redirect()->route('admin.kepmen')->with('success', $message);
    }

    //search kepmen
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        // Ambil tahun unik dari tabel kepmen_db
        $years = KepmenDb::select('tahun')->distinct()->get();
    
        // Query untuk pencarian
        $kepmenQuery = Kepmen::query();
    
        if ($query) {
            $kepmenQuery->where(function($q) use ($query) {
                $q->where('tahun', 'like', "%{$query}%")
                  ->orWhere('status', 'like', "%{$query}%")
                  ->orWhere('U', 'like', "%{$query}%")
                  ->orWhere('BU', 'like', "%{$query}%")
                  ->orWhere('P', 'like', "%{$query}%")
                  ->orWhere('K', 'like', "%{$query}%")
                  ->orWhere('SK', 'like', "%{$query}%")
                  ->orWhere('nomenklatur_urusan_kabupaten_kota', 'like', "%{$query}%")
                  ->orWhere('kinerja', 'like', "%{$query}%")
                  ->orWhere('indikator', 'like', "%{$query}%");
            });
        }
    
        $kepmen = $kepmenQuery->get();
    
        return view('admin.kepmen', compact('kepmen', 'years'));
    }
    
    // public function index(Request $request)
    // {
    //     $query = $request->input('search');
    //     $years = KepmenDb::select('tahun')->distinct()->get();
    //     $kepmen = Kepmen::query()
    //         ->where('tahun', 'like', "%{$query}%")
    //         ->orWhere('status', 'like', "%{$query}%")
    //         ->orWhere('U', 'like', "%{$query}%")
    //         ->orWhere('BU', 'like', "%{$query}%")
    //         ->orWhere('P', 'like', "%{$query}%")
    //         ->orWhere('K', 'like', "%{$query}%")
    //         ->orWhere('SK', 'like', "%{$query}%")
    //         ->orWhere('nomenklatur_urusan_kabupaten_kota', 'like', "%{$query}%")
    //         ->orWhere('kinerja', 'like', "%{$query}%")
    //         ->orWhere('indikator', 'like', "%{$query}%")
    //         ->get();

    //     return view('admin.kepmen', compact('kepmen'));
    // }
}