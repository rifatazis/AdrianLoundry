<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('administrator.mengelolaLayananDanHarga', compact('layanan'));
    }

    public function create()
    {
        return view('administrator.tambahLayanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:100',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('layanan', 'public');
        }
    
        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
        ]);
    
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }
    

    public function edit($id)
{
    $layanan = Layanan::findOrFail($id);
    return view('administrator.editLayanan', compact('layanan'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'nama_layanan' => 'required|max:100',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $layanan = Layanan::findOrFail($id);
    $layanan->nama_layanan = $request->nama_layanan;
    $layanan->harga = $request->harga;

    if ($request->hasFile('gambar')) {
        if ($layanan->gambar) {
            Storage::delete('public/' . $layanan->gambar);
        }
        $layanan->gambar = $request->file('gambar')->store('layanan', 'public');
    }

    $layanan->save();

    return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui!');
}


    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        if ($layanan->gambar) {
            Storage::delete($layanan->gambar);
        }
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
