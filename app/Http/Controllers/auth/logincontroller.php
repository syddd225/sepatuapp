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
            // Regenerasi session untuk keamanan dari Session Fixation
            $request->session()->regenerate();

            // Alihkan user ke halaman utama etalase produk setelah sukses login
            return redirect()->intended('/')->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // 3. Jika Login Gagal, Kembalikan ke Form dengan Pesan Error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Memproses pendaftaran (registrasi) akun pembeli baru
     */
    public function register(Request $request)
    {
        // 1. Validasi Ketat Data Pembeli (Sesuai form login.blade.php Anda)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi sesuai KTP.',
            'email.required' => 'Email aktif wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di sistem kami.',
            'phone.required' => 'Nomor WhatsApp wajib diisi untuk verifikasi pengrajin.',
            'address.required' => 'Alamat pengiriman lengkap wajib diisi demi menghindari order fiktif.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // 2. Simpan Data ke Database Tabel `users`
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
        return redirect('/')->with('success', 'Akun berhasil dibuat! Selamat berbelanja dengan aman.');
    }

    /**
     * Memproses keluar sistem (Logout) pembeli
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan session lama agar bersih
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}