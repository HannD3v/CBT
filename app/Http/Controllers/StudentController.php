<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

// Controller untuk pembina kelola akun siswa (CRUD siswa, reset password)
// Alur: pembina akses menu siswa -> tambah/hapus/reset password siswa -> sistem generate kredensial default
class StudentController extends Controller
{
    // Method index: tampilkan daftar semua siswa dengan pagination
    // Alur: ambil semua user dengan role siswa -> load relasi kelas -> tampilkan dalam tabel
    // Return: view daftar siswa dengan data siswa dan kelas
    public function index()
    {
        // Ambil semua siswa dengan relasi kelas, diurutkan terbaru, 15 per halaman
        $students = User::where('role', 'siswa')->with('class')->latest()->paginate(15);
        
        // Ambil semua kelas untuk filter/dropdown
        $classes = SchoolClass::all();

        return view('students.index', compact('students', 'classes'));
    }

    // Method create: tampilkan form tambah siswa baru
    // Return: view form tambah siswa dengan dropdown kelas
    public function create()
    {
        $classes = SchoolClass::all();

        return view('students.create', compact('classes'));
    }

    // Method store: proses tambah siswa baru dengan kredensial default
    // Alur: validasi input -> buat akun siswa -> generate password default -> simpan ke database -> tampilkan kredensial
    // Input: name (nama siswa), username (username unik), class_id (ID kelas), password (opsional, jika kosong pakai default)
    // Return: redirect ke daftar siswa dengan notifikasi kredensial (username & password default)
    public function store(Request $request)
    {
        // Validasi input: nama, username harus unik, kelas harus ada, password opsional
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username',
            'class_id' => 'required|exists:classes,id',
            'password' => 'nullable|string|min:6',
        ]);

        // Password default jika tidak diisi: 'password123'
        $defaultPassword = $validated['password'] ?? 'password123';

        // Buat akun siswa baru dengan role 'siswa'
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($defaultPassword), // Hash password untuk keamanan
            'role' => 'siswa',
            'class_id' => $validated['class_id'],
        ]);

        // Redirect dengan notifikasi kredensial untuk diberikan ke siswa
        return redirect()->route('students.index')->with('success', "Akun siswa berhasil dibuat. Username: {$user->username} | Default Password: {$defaultPassword}");
    }

    // Method resetPassword: reset password siswa ke default (pembina yang trigger)
    // Alur: cek apakah user adalah siswa -> reset password ke default -> notifikasi pembina
    // Params: $student (model User siswa yang akan direset passwordnya)
    // Return: redirect kembali dengan notifikasi password baru
    public function resetPassword(User $student)
    {
        // Validasi hanya siswa yang bisa direset password
        if ($student->role !== 'siswa') {
            return back()->withErrors(['error' => 'Hanya password siswa yang dapat di-reset.']);
        }

        // Password default: 'password123'
        $defaultPassword = 'password123';
        $student->update(['password' => Hash::make($defaultPassword)]);

        // Notifikasi ke pembina dengan password baru untuk diberikan ke siswa
        return back()->with('success', "Password siswa {$student->name} berhasil di-reset ke: {$defaultPassword}");
    }

    // Method destroy: hapus akun siswa
    // Alur: cek apakah user adalah siswa -> hapus dari database -> redirect dengan notifikasi
    // Params: $student (model User siswa yang akan dihapus)
    // Return: redirect ke daftar siswa dengan notifikasi sukses atau error
    public function destroy(User $student)
    {
        // Validasi hanya siswa yang bisa dihapus
        if ($student->role !== 'siswa') {
            return back()->withErrors(['error' => 'User ini bukan siswa.']);
        }

        // Hapus siswa (cascade delete akan hapus data terkait: progress, quiz attempts, submissions)
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
