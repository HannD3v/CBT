<?php

namespace App\Http\Controllers;

use App\Models\MaterialProgress;
use App\Models\QuizAttempt;
use App\Models\SchoolClass;
use App\Models\Submission;
use App\Models\User;

// Controller untuk menampilkan progress belajar siswa (siswa lihat progress sendiri, pembina lihat rekap semua siswa)
// Alur siswa: lihat materi selesai, quiz dikerjakan, challenge selesai
// Alur pembina: lihat rekap progress per kelas atau per siswa
class ProgressController extends Controller
{
    // Method index: tampilkan progress sesuai role (siswa lihat milik sendiri, pembina lihat rekap semua)
    // Alur siswa: ambil data progress materi, quiz attempts, submissions -> tampilkan dalam view
    // Alur pembina: ambil data kelas & siswa -> tampilkan rekap progress per siswa
    // Return: view progress siswa atau view rekap progress pembina
    public function index()
    {
        $user = auth()->user();

        // Jika user adalah siswa, tampilkan progress pribadi
        if ($user->role === 'siswa') {
            // Ambil progress materi dengan relasi materi
            $materialProgress = MaterialProgress::with('material')->where('user_id', $user->id)->get();
            
            // Ambil riwayat quiz attempts dengan relasi quiz, urutkan terbaru
            $quizAttempts = QuizAttempt::with('quiz')->where('user_id', $user->id)->latest()->get();
            
            // Ambil riwayat submission challenge dengan relasi challenge, urutkan terbaru
            $submissions = Submission::with('challenge')->where('user_id', $user->id)->latest()->get();

            return view('progress.siswa', compact('materialProgress', 'quizAttempts', 'submissions'));
        }

        // Jika user adalah pembina, tampilkan rekap progress semua siswa
        // Ambil semua kelas dengan jumlah siswa per kelas
        $classes = SchoolClass::withCount('students')->get();
        
        // Ambil semua siswa dengan relasi kelas, quiz attempts, dan material progress, pagination 15 per halaman
        $students = User::where('role', 'siswa')->with(['class', 'quizAttempts', 'materialProgress'])->paginate(15);

        return view('progress.pembina', compact('classes', 'students'));
    }

    // Method showStudent: tampilkan detail progress siswa tertentu (khusus pembina)
    // Alur: pembina pilih siswa -> ambil semua data progress siswa -> tampilkan dalam view detail
    // Params: $student (model User siswa yang akan dilihat progressnya)
    // Return: view detail progress siswa dengan data materi, quiz, dan challenge
    public function showStudent(User $student)
    {
        // Validasi hanya siswa yang bisa dilihat progressnya
        if ($student->role !== 'siswa') {
            abort(404);
        }

        // Ambil progress materi siswa dengan relasi materi
        $materialProgress = MaterialProgress::with('material')->where('user_id', $student->id)->get();
        
        // Ambil riwayat quiz attempts siswa dengan relasi quiz, urutkan terbaru
        $quizAttempts = QuizAttempt::with('quiz')->where('user_id', $student->id)->latest()->get();
        
        // Ambil riwayat submission challenge siswa dengan relasi challenge, urutkan terbaru
        $submissions = Submission::with('challenge')->where('user_id', $student->id)->latest()->get();

        return view('progress.student-detail', compact('student', 'materialProgress', 'quizAttempts', 'submissions'));
    }
}
