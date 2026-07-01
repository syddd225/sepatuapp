<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan halaman akun
    public function index()
    {
        $user = Auth::user();
        return view('akun', compact('user'));
    }

    // Memproses form edit profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input dari user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Simpan pembaruan ke database
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('akun')->with('success', 'Profil kamu berhasil diperbarui!');
    }
}