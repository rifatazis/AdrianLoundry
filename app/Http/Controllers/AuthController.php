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
        return view('auth.halamanLogin');
    }

    public function showRegisterForm()
    {
        return view('auth.halamanRegister');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:user',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.min' => 'Password minimal 6 karakter.'
        ]);
    
        if ($validator->fails()) {
            $message = $this->registerMessage($validator, false, $request->username);
            return redirect()->route('register')->withErrors($message['message'])->withInput();
        }
    
        User::create([
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
    



    // login
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
                return redirect()->route('administrator.halamanUtama');
            } else {
                return redirect()->route('pelanggan.halamanUtama');
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