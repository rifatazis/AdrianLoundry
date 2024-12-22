<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{

    public function index()
    {
        $layanan = Layanan::paginate(5);
        return view('administrator.halamanMengelolaLayanandanHarga', compact('layanan'));
    }

    // layanan Kelola Layanan
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:100',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenis_pakaian' => 'required|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
            'jenis_pakaian' => $request->jenis_pakaian,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // layanan Halaman Utama Administrator
    public function halamanUtama()
    {
        $layanan = Layanan::all();
        return view('administrator.halamanUtamaAdministrator', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|max:100',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jenis_pakaian' => 'required|string',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->harga = $request->harga;
        $layanan->jenis_pakaian = $request->jenis_pakaian; 

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) {
                Storage::delete('public/' . $layanan->gambar);
            }
            $layanan->gambar = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->save();

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function show($id)
    {
        $layanan = Layanan::find($id);
        if (!$layanan) {
            abort(404);
        }
        return view('layanan.show', compact('layanan'));
    }


    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        if ($layanan->gambar) {
            Storage::delete('public/' . $layanan->gambar);
        }
        $layanan->delete();

        return redirect()->route('layanan.index');
    }
}

