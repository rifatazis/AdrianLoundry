<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{

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
    
        return $this->pesanBerhasilTambah('Kode Pesanan: ' . $kode_pelacakan);
    }

    public function pesanBerhasilTambah($message)
    {
        return redirect()->route('tambahPesanan')->with('success', $message);
    }

    // menampilkan halaman tambahPesanan
    public function tambahPesanan()
    {
        $pesanans = Pesanan::with('layanan')->paginate(10);
        $layanan = Layanan::all(); 

        return view('administrator.tambahPesanan', compact('pesanans', 'layanan'));
    }

    //di proses di tampilkan di atas
    public function statusPesanan(Request $request)
    {
        $query = Pesanan::with('layanan');

        $query->orderByRaw("FIELD(status_pesanan, 'diproses') DESC");
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('kode_pesanan', 'like', "%{$search}%");
        }

        $pesanans = $query->paginate(10);
        $layanan = Layanan::all();

        return view('administrator.HalamanUbahStatusPesanan', compact('pesanans', 'layanan'));
    }

    //menampilkan pesanan
    public function lihatStatusPesanan(Request $request)
{
    $query = Pesanan::with('layanan');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('kode_pesanan', 'like', "%{$search}%");
    }

    $pesanans = $query->paginate(10);
    $layanan = Layanan::all();

    return view('administrator.HalamanLihatStatusPesanan', compact('pesanans', 'layanan'));
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
    
    //cari di administrator
    public function cari(Request $request)
    {
        $kodePesanan = $request->input('kode_pesanan');
        $pesanans = Pesanan::where('kode_pesanan', '=', $kodePesanan)->get();
    
    
        if ($pesanans->isEmpty()) {
            return $this->tidakDitemukan('Kode pesanan tidak ditemukan.');
        }
    
        return view('administrator.HalamanLihatStatusPesanan', compact('pesanans'));
    }    
    public function tidakDitemukan($pesan)
    {
        return view('administrator.HalamanLihatStatusPesanan', ['error' => $pesan]);
    }

    
    // cari di pelanggan
    public function carii(Request $request)
    {
        $kodePesanan = $request->input('kode_pesanan');
        $pesanans = Pesanan::where('kode_pesanan', $kodePesanan)->get();
    
        if ($pesanans->isEmpty()) {
            return $this->tidakDitemukann('Kode pesanan tidak ditemukan.');
        }
    
        return view('pelanggan.halamanUtama', compact('pesanans'));
    }
    
    public function tidakDitemukann($pesan)
    {
        return redirect()->route('pelanggan.halamanUtama')->with('error', $pesan);
    }

}
