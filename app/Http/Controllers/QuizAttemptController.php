<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use Illuminate\Http\Request;

// Controller untuk siswa kerjakan quiz (start quiz, submit jawaban, hitung skor otomatis, lihat hasil)
// Alur: siswa pilih quiz -> start attempt -> jawab soal -> submit -> sistem hitung skor otomatis -> tampilkan hasil & pembahasan
class QuizAttemptController extends Controller
{
    // Method start: mulai quiz baru (buat attempt baru untuk siswa)
    // Alur: siswa klik mulai quiz -> sistem buat record attempt baru -> redirect ke halaman pengerjaan
    // Params: $quiz (model Quiz yang akan dikerjakan)
    // Return: redirect ke halaman pengerjaan quiz (quiz-attempts.show)
    public function start(Quiz $quiz)
    {
        // Buat attempt baru untuk siswa yang sedang login
        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
        ]);

        // Redirect ke halaman pengerjaan quiz
        return redirect()->route('quiz-attempts.show', $attempt->id);
    }

    // Method show: tampilkan halaman pengerjaan quiz (soal & pilihan jawaban)
    // Alur: cek akses (hanya siswa pemilik atau pembina) -> load soal & jawaban -> tampilkan form pengerjaan
    // Params: $attempt (model QuizAttempt yang sedang dikerjakan)
    // Return: view pengerjaan quiz dengan data soal dan jawaban
    public function show(QuizAttempt $attempt)
    {
        // Validasi akses: hanya siswa pemilik atau pembina yang bisa melihat
        if ($attempt->user_id !== auth()->id() && auth()->user()->role !== 'pembina') {
            abort(403);
        }

        // Load relasi quiz, soal, jawaban, dan jawaban siswa (jika sudah submit)
        $attempt->load(['quiz.questions.answers', 'answers']);

        return view('quiz-attempts.show', compact('attempt'));
    }

    // Method submit: proses jawaban siswa & hitung skor otomatis
    // Alur: validasi jawaban -> cek jawaban benar/salah per soal -> hitung skor -> simpan hasil -> redirect ke hasil
    // Params: $attempt (model QuizAttempt yang akan disubmit)
    // Input: answers (array jawaban siswa, key = question_id, value = answer_id)
    // Return: redirect ke halaman hasil quiz (quiz-attempts.result)
    public function submit(Request $request, QuizAttempt $attempt)
    {
        // Validasi akses: hanya siswa pemilik yang bisa submit
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        // Validasi input: jawaban wajib diisi untuk setiap soal, answer_id harus valid
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:answers,id',
        ]);

        $correctCount = 0; // Counter jawaban benar
        $totalQuestions = $attempt->quiz->questions()->count(); // Total soal dalam quiz

        // Loop semua jawaban siswa
        foreach ($validated['answers'] as $questionId => $answerId) {
            // Ambil data jawaban dari database
            $answer = Answer::find($answerId);
            $isCorrect = $answer ? $answer->is_correct : false; // Cek apakah jawaban benar

            // Jika jawaban benar, tambah counter
            if ($isCorrect) {
                $correctCount++;
            }

            // Simpan jawaban siswa ke tabel quiz_attempt_answers
            QuizAttemptAnswer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $questionId,
                'answer_id' => $answerId,
                'is_correct' => $isCorrect,
            ]);
        }

        // Hitung skor (persentase jawaban benar dari total soal)
        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0;

        // Update attempt dengan skor dan waktu submit
        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
        ]);

        // Redirect ke halaman hasil quiz
        return redirect()->route('quiz-attempts.result', $attempt->id);
    }

    // Method result: tampilkan hasil quiz & pembahasan (jawaban benar/salah per soal)
    // Alur: cek akses (hanya siswa pemilik atau pembina) -> load data attempt & jawaban -> tampilkan hasil & pembahasan
    // Params: $attempt (model QuizAttempt yang akan ditampilkan hasilnya)
    // Return: view hasil quiz dengan skor, jawaban siswa, dan jawaban benar
    public function result(QuizAttempt $attempt)
    {
        // Validasi akses: hanya siswa pemilik atau pembina yang bisa melihat hasil
        if ($attempt->user_id !== auth()->id() && auth()->user()->role !== 'pembina') {
            abort(403);
        }

        // Load relasi quiz, jawaban siswa, soal, dan jawaban benar
        $attempt->load(['quiz', 'answers.question', 'answers.answer']);

        return view('quiz-attempts.result', compact('attempt'));
    }
}
