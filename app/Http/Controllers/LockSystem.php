<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LockSystem extends Controller
{
    public function showLockScreen()
    {
        if (session('locked')) {
            return view('lock'); 
        }
    
        return redirect('/'); 
    }
    
    public function unlock(Request $request)
    {
        $pengguna = Pengguna::where('username', Auth::user()->username)->first();

        if ($pengguna && password_verify($request->password, $pengguna->password)) {
            session(['locked' => false]); 

            if ($pengguna->hasRole('administrator')) {
                return redirect()->route('administrator.HalamanUtamaAdministrator');
            } elseif ($pengguna->hasRole('pelanggan')) {
                return redirect()->route('pelanggan.HalamanUtama');
            }

            return redirect('/'); 
        }

        return redirect()->back()->with('error', 'Password salah!');
    }
    
    
}
