<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function tampilLogin()
    {
        return view('auth.halamanLogin');
    }

    public function tampilRegister()
    {
        return view('auth.halamanRegister');
    }

    // register
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.min' => 'Password minimal 6 karakter.'
        ]);
    
        
        if ($validator->fails()) {
            $message = $this->registerMessage($validator, false, $request->username);
            return redirect()->route('register')->withErrors($message['message'])->withInput();
        }

        
        Users::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);
    
        $message = $this->registerMessage(null, true, $request->username);
        return redirect()->route('login')->with('success', $message['message'][0]);
    }
    
    
    private function registerMessage($validator = null, $success = false, $username = null)
    {
        if ($validator) {
            if ($validator->errors()->has('username')) {
                return [
                    'status' => 'error',
                    'message' => ['Username "' . $username . '" sudah terpakai.']
                ];
            }
            return [
                'status' => 'error',
                'message' => [$validator->errors()->first()]
            ];
        }
    
        if ($success) {
            return [
                'status' => 'success',
                'message' => ['Akun "' . $username . '" berhasil tersimpan.']
            ];
        }
    
        return [
            'status' => 'error',
            'message' => ['Terjadi kesalahan. Silakan coba lagi.']
        ];
    }

    // Login
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
            $users = Auth::user();
            if ($users->role == 'administrator') {
                return redirect()->route('administrator.halamanUtamaAdministrator');
            } else {
                return redirect()->route('pelanggan.halamanUtama');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
    }

        public function loginMesaage($message)
    {
        return redirect()->back()->with('error', $message);
    }


    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
