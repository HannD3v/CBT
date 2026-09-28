<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\SchoolClass;
use App\Models\Submission;
use App\Models\User;

// Controller untuk menampilkan dashboard pembina dan siswa
// Alur: user login -> akses dashboard sesuai role -> tampilkan statistik dan data terkait
class DashboardController extends Controller
{
    // Method pembina: tampilkan dashboard pembina dengan statistik dan data siswa
    // Alur: hitung total siswa, materi, quiz, challenge, submission pending -> ambil data kelas dan quiz attempts terbaru
    // Return: view dashboard pembina dengan data statistik, kelas, dan riwayat quiz attempts
    public function pembina()
    {
        // Hitung statistik utama untuk pembina
        $stats = [
            'total_students' => User::where('role', 'siswa')->count(), // Total siswa terdaftar
            'total_materials' => Material::count(), // Total materi
            'total_quizzes' => Quiz::count(), // Total quiz
            'total_challenges' => Challenge::count(), // Total challenge
            'pending_submissions' => Submission::where('status', 'menunggu')->count(), // Submission yang belum direview
        ];

        // Ambil data kelas beserta jumlah siswa per kelas
        $classes = SchoolClass::withCount('students')->get();

        // Ambil 5 quiz attempts terbaru dari semua siswa untuk monitoring
        $recentAttempts = QuizAttempt::with(['user', 'quiz'])->latest()->limit(5)->get();

        return view('dashboard.pembina', compact('stats', 'classes', 'recentAttempts'));
    }

    // Method siswa: tampilkan dashboard siswa dengan statistik progress belajar
    // Alur: ambil user login -> hitung progress materi, quiz, challenge -> ambil data materi dan quiz terbaru
    // Return: view dashboard siswa dengan data statistik, materi terbaru, dan quiz terbaru
    public function siswa()
    {
        $user = auth()->user();

        // Hitung statistik progress belajar siswa
        $stats = [
            'completed_materials' => MaterialProgress::where('user_id', $user->id)->where('status', 'selesai')->count(), // Materi selesai dipelajari
            'completed_quizzes' => QuizAttempt::where('user_id', $user->id)->whereNotNull('submitted_at')->count(), // Quiz yang sudah dikerjakan
            'completed_challenges' => Submission::where('user_id', $user->id)->where('status', 'selesai')->count(), // Challenge yang sudah selesai
        ];

        // Ambil 4 materi terbaru untuk rekomendasi belajar
        $recentMaterials = Material::with('category')->latest()->limit(4)->get();

        // Ambil 4 quiz terbaru yang tersedia
        $recentQuizzes = Quiz::with('material')->latest()->limit(4)->get();

        return view('dashboard.siswa', compact('stats', 'recentMaterials', 'recentQuizzes'));
    }
}
