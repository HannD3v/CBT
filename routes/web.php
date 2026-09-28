<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - JoyLish
|--------------------------------------------------------------------------
| Rute aplikasi JoyLish: Guest, Auth, Pembina, Siswa, dan Shared.
*/

// --- Root & Guest Routes ---
// Redirect root ke halaman login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->role === 'pembina' ? 'dashboard.pembina' : 'dashboard.siswa');
    }
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    // Form login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Proses autentikasi login
    Route::post('/login', [AuthController::class, 'login']);
});

// --- Authenticated Routes ---
Route::middleware('auth')->group(function () {

    // Logout user dan hapus session
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Form ganti password
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    // Proses update password baru
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // ========================================================================
    // RUTE PEMBINA (Guru / Admin)
    // ========================================================================
    Route::middleware('role:pembina')->group(function () {
        // Dashboard statistik pembina
        Route::get('/dashboard/pembina', [DashboardController::class, 'pembina'])->name('dashboard.pembina');

        // CRUD akun siswa (daftar, form tambah, simpan, hapus)
        Route::resource('students', StudentController::class)->except(['show', 'edit', 'update']);
        // Reset password siswa ke default
        Route::post('/students/{student}/reset-password', [StudentController::class, 'resetPassword'])->name('students.reset-password');

        // Form tambah materi baru
        Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
        // Simpan materi baru
        Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
        // Form edit materi
        Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
        // Update data materi
        Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
        // Hapus materi
        Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

        // Form buat quiz baru
        Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
        // Simpan data quiz baru
        Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
        // Tambah soal & opsi jawaban ke quiz
        Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('quizzes.questions.store');
        // Hapus quiz beserta attempts terkait
        Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');

        // Detail progress belajar siswa tertentu
        Route::get('/progress/students/{student}', [ProgressController::class, 'showStudent'])->name('progress.student');
    });

    // ========================================================================
    // RUTE SISWA
    // ========================================================================
    Route::middleware('role:siswa')->group(function () {
        // Dashboard progress belajar siswa
        Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'])->name('dashboard.siswa');

        // Mulai pengerjaan quiz baru
        Route::post('/quiz-attempts/{quiz}/start', [QuizAttemptController::class, 'start'])->name('quiz-attempts.start');
        // Halaman pengerjaan soal quiz
        Route::get('/quiz-attempts/{attempt}', [QuizAttemptController::class, 'show'])->name('quiz-attempts.show');
        // Submit jawaban dan kalkulasi skor otomatis
        Route::post('/quiz-attempts/{attempt}/submit', [QuizAttemptController::class, 'submit'])->name('quiz-attempts.submit');
        // Lihat hasil skor dan pembahasan quiz
        Route::get('/quiz-attempts/{attempt}/result', [QuizAttemptController::class, 'result'])->name('quiz-attempts.result');
    });

    // ========================================================================
    // SHARED ROUTES (Pembina & Siswa)
    // ========================================================================
    // Daftar materi pembelajaran & filter kategori
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    // Baca materi & auto-tracking progress selesai
    Route::get('/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');

    // Daftar quiz yang tersedia
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    // Detail quiz dan daftar soal
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');

    // Rekap progress (siswa: pribadi, pembina: per kelas)
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
});
