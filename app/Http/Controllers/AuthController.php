<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:user',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }
    
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password here
            'role' => 'pelanggan', 
        ]);
    
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role == 'administrator') {
                return redirect()->route('administrator.dashboard');
            } else {
                return redirect()->route('pelanggan.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
               
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
