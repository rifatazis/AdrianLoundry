<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function tambahPesanan()
    {
        $pesanans = Pesanan::with('layanan')->paginate(10);
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
    $pesanan = Pesanan::findOrFail($id);

    if ($pesanan->status_pesanan === 'selesai') {
        return response()->json(['success' => false, 'message' => '']);
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
            // 'jenis_pakaian' => 'required|string|max:255',
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
            // 'jenis_pakaian' => $request->jenis_pakaian,
            'status_pesanan' => 'diproses',
        ]);
    
        return redirect()->route('tambahPesanan')->with('success', 'Kode Pesanan: ' . $kode_pelacakan);
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


    


    
    

}
