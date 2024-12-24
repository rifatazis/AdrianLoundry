<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
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
            'username' => 'required|string|max:50|unique:pengguna',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.'
        ]);


        if ($validator->fails()) {
            $message = $this->registerMessage($validator, false, $request->username);
            return redirect()->route('register')->withErrors($message['message'])->withInput();
        }


        Pengguna::create([
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
        $maxAttempts = 3;
        $lockoutTime = 30; 

        $attempts = session()->get('login_attempts', 0);
        $lastAttemptTime = session()->get('last_attempt_time', now());

        if ($attempts >= $maxAttempts) {
            $timeElapsed = now()->diffInSeconds($lastAttemptTime);

            if ($timeElapsed < $lockoutTime) {
                $remainingTime = $lockoutTime - $timeElapsed;

                return redirect()->route('login')->with([
                    'error' => "Terlalu banyak percobaan login. Silakan coba lagi dalam <span id='countdown'>$remainingTime</span> detik.",
                    'remaining_time' => $remainingTime, 
                ]);
            }

            session()->forget(['login_attempts', 'last_attempt_time']);
            $attempts = 0;
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        // Proses autentikasi
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            session()->forget(['login_attempts', 'last_attempt_time', 'error']);

            $user = Auth::user();
            if ($user->role == 'administrator') {
                return redirect()->route('administrator.HalamanUtamaAdministrator');
            } else {
                return redirect()->route('pelanggan.halamanUtama');
            }
        } else {
            $attempts++;
            session()->put('login_attempts', $attempts);
            session()->put('last_attempt_time', now());

            $remainingAttempts = $maxAttempts - $attempts;

            if ($attempts >= $maxAttempts) {
                return redirect()->route('login')->with([
                    'error' => "Terlalu banyak percobaan login. Silakan coba lagi dalam <span id='countdown'>$lockoutTime</span> detik.",
                    'remaining_time' => $lockoutTime,
                ]);
            }

            return redirect()->route('login')->with([
                'error' => 'Username atau password salah.',
                'remaining_attempts' => max($remainingAttempts, 0),
            ]);
        }
    }


    public function loginMessage($message)
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
