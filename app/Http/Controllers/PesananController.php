<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function tambahPesanan()
    {
        $pesanans = Pesanan::with('layanan')->get();
        $layanan = Layanan::all(); 

        return view('administrator.tambahPesanan', compact('pesanans', 'layanan'));
    }

    public function statusPesanan(Request $request)
    {
        $query = Pesanan::with('layanan');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('kode_pesanan', 'like', "%{$search}%");
        }

        $pesanans = $query->paginate(10);
        $layanan = Layanan::all();

        return view('administrator.statusPesanan', compact('pesanans', 'layanan'));
    }

    public function lihatStatusPesanan(Request $request)
{
    $query = Pesanan::with('layanan');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('kode_pesanan', 'like', "%{$search}%");
    }

    $pesanans = $query->paginate(10);
    $layanan = Layanan::all();

    return view('administrator.lihatStatusPesanan', compact('pesanans', 'layanan'));
}


    public function ubahStatusPesanan(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:diproses,selesai',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status_pesanan === 'selesai') {
            return response()->json(['success' => false, 'message' => 'Status selesai tidak dapat diubah lagi.']);
        }

        $pesanan->status_pesanan = $request->status_pesanan;
        $pesanan->save();

        return response()->json(['success' => true]);
    }

    //menampilkan pesanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_pesanan' => 'required|date',
        ]);
    
        $layanan = Layanan::find($request->id_layanan);
        $total_harga = $layanan->harga * $request->berat;
        $kode_pelacakan = strtoupper(substr(md5(time()), 0, 3)); 
        
    
        Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'kode_pesanan' => $kode_pelacakan,
            'id_user' => auth()->id(),
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'tanggal_pesanan' => $request->tanggal_pesanan,
            'status_pesanan' => 'diproses',
        ]);
    
        return redirect()->route('tambahPesanan')->with('success', 'Pesanan berhasil disimpan. Kode Pelacakan: ' . $kode_pelacakan);
    }

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

        return view('administrator.keuangan', compact('pesanans', 'totalPemasukan', 'bulan', 'tahun'));
    }

    //cari di administrator
    public function cari(Request $request)
    {
        $kodePesanan = $request->input('kode_pesanan');
        $pesanans = Pesanan::where('kode_pesanan', $kodePesanan)->get();

        if ($pesanans->isEmpty()) {
            return redirect()->route('pesanan.index')->with('success', 'Kode pesanan tidak ditemukan.');
        }

        return view('administrator.lihatStatusPesanan', compact('pesanans'));
    }

    
    // cari di pelanggan
    public function carii(Request $request)
    {
        $kodePesanan = $request->input('kode_pesanan');
        $pesanans = Pesanan::where('kode_pesanan', $kodePesanan)->get();
    
        if ($pesanans->isEmpty()) {
            return redirect()->route('pelanggan.halamanUtama')->with('success', 'Kode pesanan tidak ditemukan.');
        }
    
        return view('pelanggan.halamanUtama', compact('pesanans'));
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
    
        return view('administrator.lihatStatistik', compact('labels', 'data', 'bulan', 'tahun'));
    }
    


    
    

}
