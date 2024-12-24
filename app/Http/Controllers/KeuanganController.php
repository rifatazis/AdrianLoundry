<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function dataPemasukan(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;  
        $tahun = $request->tahun ?? now()->year;

        $pesanans = Pesanan::where('status_pesanan', 'selesai')
                        ->whereYear('tanggal_pesanan', $tahun)
                        ->whereMonth('tanggal_pesanan', $bulan)
                        ->paginate(10); 

        $totalPemasukan = Pesanan::where('status_pesanan', 'selesai')
                                ->whereYear('tanggal_pesanan', $tahun)
                                ->whereMonth('tanggal_pesanan', $bulan)
                                ->sum('total_harga');

        return view('administrator.HalamanLihatDataPemasukan', compact('pesanans', 'totalPemasukan', 'bulan', 'tahun'));
    }


    public function statistik(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
    
        $dataPemasukan = Pesanan::where('status_pesanan', 'selesai')
                                ->whereYear('tanggal_pesanan', $tahun)
                                ->whereMonth('tanggal_pesanan', $bulan)
                                ->selectRaw('DAY(tanggal_pesanan) as hari, SUM(total_harga) as total_pemasukan')
                                ->groupBy('hari')
                                ->orderBy('hari')
                                ->get();
    
        $labels = [];
        $data = [];
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $pemasukanHari = $dataPemasukan->firstWhere('hari', $i);
            $labels[] = $i;
            $data[] = $pemasukanHari ? $pemasukanHari->total_pemasukan : 0;
        }
    
        $totalPemasukan = Pesanan::where('status_pesanan', 'selesai')
                                 ->whereYear('tanggal_pesanan', $tahun)
                                 ->whereMonth('tanggal_pesanan', $bulan)
                                 ->sum('total_harga');
    
        return view('administrator.HalamanLihatStatistik', compact('labels', 'data', 'bulan', 'tahun', 'totalPemasukan'));
    }
    
    
}