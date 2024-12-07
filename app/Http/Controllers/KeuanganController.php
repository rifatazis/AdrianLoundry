<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m')); 
        $tahun = $request->get('tahun', date('Y')); 

        $pesanans = Pesanan::where('status_pesanan', 'selesai')
                          ->whereMonth('tanggal_pesanan', $bulan)
                          ->whereYear('tanggal_pesanan', $tahun)
                          ->paginate(10);
        $totalPemasukan = Pesanan::where('status_pesanan', 'selesai')
                                ->whereMonth('tanggal_pesanan', $bulan)
                                ->whereYear('tanggal_pesanan', $tahun)
                                ->sum('total_harga');

        return view('administrator.keuangan', compact('pesanans', 'totalPemasukan', 'bulan', 'tahun'));
    }
}