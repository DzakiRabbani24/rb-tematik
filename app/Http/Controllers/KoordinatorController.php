<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function evaluasi()
    {
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.evaluasi');
    }
    
    public function roadmap()
    {
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.roadmap');
    }
    
    public function rencanaaksi()
    {
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.rencanaaksi');
    }
}