<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Controller untuk autentikasi (login, logout, ganti password)
// Alur: user akses form login -> submit username/password -> cek ke database -> redirect sesuai role
class AuthController extends Controller
{
    // Method showLoginForm: tampilkan halaman form login
    // Return: view form login (auth.login)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Method login: proses login user (siswa/pembina)
    // Alur: validasi input -> cek username/password di database -> redirect sesuai role atau error
    // Input: username (string), password (string)
    // Return: redirect ke dashboard pembina atau siswa, atau kembali ke form login dengan error
    public function login(Request $request)
    {
        // Validasi input username dan password wajib diisi
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek username dan password ke database
        if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect sesuai role: pembina ke dashboard pembina, siswa ke dashboard siswa
            return $user->role === 'pembina' ? redirect()->route('dashboard.pembina') : redirect()->route('dashboard.siswa');
        }

        // Jika login gagal, kembali ke form dengan error
        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }

    // Method logout: proses logout user
    // Alur: logout -> hapus session -> redirect ke halaman login
    // Return: redirect ke halaman login
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Method showChangePassword: tampilkan form ganti password
    // Return: view form ganti password (auth.change-password)
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    // Method changePassword: proses ganti password siswa
    // Alur: validasi input -> cek password lama -> update password baru -> redirect
    // Input: current_password (password lama), password (password baru), password_confirmation (konfirmasi password baru)
    // Return: redirect ke dashboard siswa dengan notifikasi sukses atau error
    public function changePassword(Request $request)
    {
        // Validasi input: password lama wajib, password baru min 8 karakter dan harus sama dengan konfirmasi
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($validated['current_password'], auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak benar.']);
        }

        // Update password baru (otomatis di-hash oleh model User)
        auth()->user()->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('dashboard.siswa')->with('success', 'Password berhasil diubah.');
    }
}
