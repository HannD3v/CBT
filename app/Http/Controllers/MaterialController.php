<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialProgress;
use Illuminate\Http\Request;

// Controller untuk kelola materi pembelajaran (pembina CRUD, siswa view & track progress)
// Alur pembina: buat/edit/hapus materi -> siswa akses materi -> sistem catat progress otomatis
class MaterialController extends Controller
{
    // Method index: tampilkan daftar materi dengan filter kategori
    // Alur: ambil semua materi -> load relasi kategori & creator -> filter jika ada kategori dipilih -> pagination
    // Input (opsional): category_id (filter berdasarkan kategori)
    // Return: view daftar materi dengan data materi dan kategori
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown filter
        $categories = Category::all();
        
        // Query materi dengan relasi kategori dan pembuat
        $query = Material::with(['category', 'creator']);

        // Filter berdasarkan kategori jika ada parameter category_id
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Ambil materi dengan pagination 10 per halaman
        $materials = $query->latest()->paginate(10);

        return view('materials.index', compact('materials', 'categories'));
    }

    // Method create: tampilkan form tambah materi baru (khusus pembina)
    // Return: view form tambah materi dengan dropdown kategori
    public function create()
    {
        $categories = Category::all();

        return view('materials.create', compact('categories'));
    }

    // Method store: proses tambah materi baru (khusus pembina)
    // Alur: validasi input -> simpan ke database dengan created_by = pembina login -> redirect
    // Input: category_id (ID kategori), title (judul materi), content (isi materi)
    // Return: redirect ke daftar materi dengan notifikasi sukses
    public function store(Request $request)
    {
        // Validasi input: kategori harus ada, title & content wajib diisi
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Set created_by otomatis dari pembina yang sedang login
        $validated['created_by'] = auth()->id();

        // Simpan materi ke database
        Material::create($validated);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    // Method show: tampilkan detail materi & auto-tracking progress siswa
    // Alur: siswa buka materi -> sistem catat progress 'selesai' otomatis -> tampilkan materi & quiz terkait
    // Params: $material (model Material yang akan ditampilkan)
    // Return: view detail materi dengan data materi, kategori, dan quiz terkait
    public function show(Material $material)
    {
        // Load relasi kategori dan quiz terkait materi
        $material->load(['category', 'quizzes']);

        // Jika user adalah siswa, catat otomatis progress 'selesai' saat materi dibuka
        if (auth()->user()->role === 'siswa') {
            MaterialProgress::updateOrCreate(
                ['user_id' => auth()->id(), 'material_id' => $material->id], // Cek apakah sudah ada progress
                ['status' => 'selesai', 'completed_at' => now()] // Update atau buat progress baru
            );
        }

        return view('materials.show', compact('material'));
    }

    // Method edit: tampilkan form edit materi (khusus pembina)
    // Params: $material (model Material yang akan diedit)
    // Return: view form edit materi dengan data materi dan kategori
    public function edit(Material $material)
    {
        $categories = Category::all();

        return view('materials.edit', compact('material', 'categories'));
    }

    // Method update: proses update materi (khusus pembina)
    // Alur: validasi input -> update data materi di database -> redirect
    // Params: $material (model Material yang akan diupdate)
    // Input: category_id (ID kategori), title (judul materi), content (isi materi)
    // Return: redirect ke daftar materi dengan notifikasi sukses
    public function update(Request $request, Material $material)
    {
        // Validasi input sama seperti create
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update data materi
        $material->update($validated);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil diubah.');
    }

    // Method destroy: hapus materi (khusus pembina)
    // Alur: hapus materi dari database (cascade delete akan hapus quiz & progress terkait) -> redirect
    // Params: $material (model Material yang akan dihapus)
    // Return: redirect ke daftar materi dengan notifikasi sukses
    public function destroy(Material $material)
    {
        // Hapus materi (cascade delete otomatis hapus quiz, progress, dll)
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}
