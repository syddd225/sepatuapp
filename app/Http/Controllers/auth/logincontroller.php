<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Memproses autentikasi login pembeli
     */
    public function login(Request $request)
    {
        // 1. Validasi Input Form Login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Coba Lakukan Login (Attempt)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Sesuai arahan: dialihkan ke halaman yang sedang ingin diakses (misal halaman checkout tadi)
            return redirect()->intended('/');
        }

        // 3. Jika Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah. Akses ke situs ditolak.',
        ])->onlyInput('email');
    }

    /**
     * Memproses pendaftaran (registrasi) akun pembeli baru
     */
    public function register(Request $request)
    {
        // 1. Validasi Ketat Data Pendaftaran
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:8|confirmed', 
        ], [
            'name.required' => 'Nama lengkap wajib diisi sesuai KTP.',
            'email.required' => 'Email aktif wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di sistem kami.',
            'phone.required' => 'Nomor WhatsApp wajib diisi untuk verifikasi pengrajin.',
            'address.required' => 'Alamat pengiriman lengkap wajib diisi demi menghindari order fiktif.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi autentikasi sandi tidak cocok! Silakan periksa kembali.',
        ]);

        // 2. Jika lolos validasi, simpan ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // 3. Otomatis Login setelah Berhasil Daftar
        Auth::login($user);

        // 4. Alihkan ke halaman utama
        return redirect('/');
    }

    /**
     * Memproses keluar sistem (Logout) pembeli
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembali bersih ke halaman login tanpa membawa flash message sukses
        return redirect('/login');
    }
}